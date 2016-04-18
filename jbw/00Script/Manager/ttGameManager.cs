using UnityEngine;
using System.Collections;
using UniRx;
using System;



public enum GameStatus
{
    READY,
    RUN,
    END
}


public class ttGameManager : MonoBehaviour
{


    //moon//프로토타입용 /// <summary>
    public bool IsTestMode;
    public float heroSpeed;
    public float beamSpeed;
    public float beamMinusHeight;
    int levelNum = -20;
    int chanceToGetGold = 70; // 빔터치 시 골드얻을 확률
    /// </summary>


    private static ttGameManager s_instance = null;
    public static ttGameManager i
    {
        get
        {
            if (s_instance == null) s_instance = FindObjectOfType(typeof(ttGameManager)) as ttGameManager;
            return s_instance;
        }
    }



    public ttHeroController hero;
    public ttBossController boss;
    public ttTouchPointController[] arrayTouchPoint;

    int beamOrderIndex = 0;
    int beamOrderMax = 3;


    int level = 0;
    public int Level
    {
        get { return level; }
        set
        {
            level = value;
            Label_Level.text = level.ToString();
        }
    }
    public UILabel Label_Level;

    int point = 0;

    public int Point
    {
        get { return point; }
        set
        {
            point = value;
            Label_Point.text = point.ToString();
        }
    }
    public UILabel Label_Point;
    public UILabel Label_Count; //moon//test

    public GameObject goEndLevelCutScene;

    public Animation aniCam;

    bool isStarted;
    public bool IsStarted
    {
        get { return isStarted; }
        set
        {
            isStarted = value;
            this.Label_Count.gameObject.SetActive(isStarted ? false : true);//moon//test
        }
    }

    public GameStatus gameState = GameStatus.READY;
    public UIPanel Panel_Gameover;



    public IEnumerator Start()
    {
        Label_Count.text = "2";
        yield return new WaitForSeconds(1f);
        Label_Count.text = "1";
        yield return new WaitForSeconds(1f);
        Label_Count.text = "Start!";
        yield return new WaitForSeconds(1f);

        StartCoroutine(RunStage());
    }

    private IEnumerator Ready()
    {
        this.gameState = GameStatus.READY;


        //moon// 빠른 작업을 위 타임을 1초만 기다림.
        Label_Count.text = "1";
        yield return new WaitForSeconds(1f);
        Label_Count.text = "Start!";

        this.ResetStage();

        yield return new WaitForSeconds(1f);

        StartCoroutine(RunStage());
    }

    private IEnumerator RunStage()
    {
        this.gameState = GameStatus.RUN;

        this.IsStarted = true;
        boss.hit = false;

        hero.MoveRight();

        yield return new WaitForSeconds(heroSpeed);//moon// 박진감 위해 텀을 줄임.

        if (this.gameState == GameStatus.END)
        {
            this.Panel_Gameover.gameObject.SetActive(true);

            while (this.gameState == GameStatus.END)
            {
                yield return null;
            }

            this.Panel_Gameover.gameObject.SetActive(false);

            StartCoroutine(Ready());
        }
        else
        {
            StartCoroutine(Ready());
        }
    }





    public void OnClickTouchPoint()
    {
        if (this.gameState == GameStatus.END) return;



        if (this.beamOrderIndex != this.beamOrderMax)
        {
            arrayTouchPoint[this.beamOrderIndex].MoveBeamUp();
            this.beamOrderIndex++;
        }
    }

    public void CheckGradeFromBoss()
    {
        if (hero.Grade == 3)
        {

            boss.OnDamage();
            if (boss.Health != 0)
            {
                hero.MakeFxHit();
                hero.SoundPunchShort();
                aniCam.Rewind();
                aniCam.Play();
            }
        }
        else
        {
            this.gameState = GameStatus.END;
            hero.OnGameOver();

            if (IsTestMode)
            {
                boss.OnDamage();
            }
        }
    }

    void ResetStage()
    {
        //moon// 프로토타입 테스트용
        heroSpeed -= 0.05f;
        beamMinusHeight =levelNum * levelNum / 10f;
        levelNum++;
        hero.setSpeed(heroSpeed);
        for (int i = 0; i < 3; i++)
        {
            arrayTouchPoint[i].setSpeed(beamSpeed);
            arrayTouchPoint[i].setHeight(beamMinusHeight);
        }
        ////////////////////////


        foreach (var tp in arrayTouchPoint)
        {
            tp.goBeam.SetActive(true);
            tp.isPassing = false;
            tp.ResetBeam();
        }

        this.beamOrderIndex = 0;
        hero.Grade = 0;
        hero.ResetPosition();
        boss.ResetPosition();

        if (boss.Health <= 0)
        {
            this.goEndLevelCutScene.SetActive(false);

            this.Level++;
            boss.Reset();


        }
    }

    public void OnEndLevel()
    {
        this.goEndLevelCutScene.SetActive(true);

        Observable.Timer(TimeSpan.FromSeconds(1.5f)).Subscribe(x =>
        {
            this.goEndLevelCutScene.SetActive(false);
            this.IsStarted = false;

            //this.boss.MoveRight(); //moon// 반복 테스트 위해 주석처리.
        });

    }

    void ResetGame()
    {
        this.Point = 0;
        this.Level = 0;
        boss.Reset();
    }

    public void TransformHero()
    {
        this.hero.Grade++;

        //빔터치시 70퍼센트 확률로 골드획득
        if (UnityEngine.Random.Range(0, 100) < this.chanceToGetGold)
        {
            this.Point++;
            this.hero.goCoinEffect.SetActive(false);
            this.hero.goCoinEffect.SetActive(true);
        }
    }

    public void OnButtonPlay()
    {
        this.gameState = GameStatus.READY;
    }
}
