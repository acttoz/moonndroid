using UnityEngine;
using System.Collections;
using System;
using UniRx;

public class ttHeroController : MonoBehaviour {

    public ttCharacterController Character;
    float startPosX = -13f;
    float endPosX = 14f;
    float speed = 3f;       //낮을수록 빠르다.

    public GameObject fxTransBlue;
    public GameObject fxTransPurple;
    public GameObject fxTransOrange;

    public GameObject goGlasses;
    public GameObject goCoinEffect;

    int grade = 0;
    public int Grade
    {
        get { return grade; }
        set 
        {
            grade = value;
            Character.ChangeSprite(grade);

            if (grade != 0)
            {
                this.MakeFxTransform();
                this.SoundTransform();
            }
                
        }
    }

    public void MoveRight()
    {
        TweenPosition.Begin(this.gameObject, speed, Vector3.right * endPosX);
    }

    public void ResetPosition()
    {
		Character.flipSprite (false);
        //transform.position = new Vector3(startPosX, 0, 0);
		Character.fxHit.SetActive(false);

        TweenPosition.Begin(this.gameObject, 0.5f, Vector3.right * (startPosX * 0.1f) + Vector3.up * 4);
        Observable.Timer(TimeSpan.FromSeconds(0.5f)).Subscribe(x =>{
        TweenPosition.Begin(this.gameObject, 0.5f, Vector3.right * startPosX);
        });

        
    }

    public void ChangeSpeed(float amount)
    {
        speed += amount;
    }


	//moon//프로토타입용 -------------
	public void setSpeed(float amount)
	{
		speed = amount;
	}
	//moon//프로토타입용 ------------


    public void MakeFxTransform()
    {
        //Instantiate(Character.fxTransform, transform.position, Quaternion.identity);

        if (this.Grade == 1)
        {
            this.fxTransBlue.SetActive(true);
            Observable.Timer(TimeSpan.FromSeconds(.5f)).Subscribe(x =>
            {
                this.fxTransBlue.SetActive(false);
            });
        }
        else if (this.Grade == 2)
        {
            this.fxTransPurple.SetActive(true);
            Observable.Timer(TimeSpan.FromSeconds(.5f)).Subscribe(x =>
            {
                this.fxTransPurple.SetActive(false);
            });
        }
        else if (this.Grade == 3)
        {
            this.fxTransOrange.SetActive(true);
            Observable.Timer(TimeSpan.FromSeconds(.5f)).Subscribe(x =>
            {
                this.fxTransOrange.SetActive(false);
            });
        }
    }

    public void MakeFxHit()
    {
//        Instantiate(Character.fxHit, transform.position + Vector3.right, Quaternion.identity);//moon// 세밀한 위치조정을 위해 setactive함수로 대체
		Character.fxHit.SetActive(true);
		Character.flipSprite (true);
    }


    public void SoundTransform()
    {
        Character.characterAudio.PlayOneShot(Character.sfxTransform);
    }

    public void SoundPunchShort()
    {
        Character.characterAudio.PlayOneShot(Character.sfxPunchShort);
    }

    public void OnGameOver()
    {
        this.Character.ChangeSprite(4); // 인덱스4 : dizzy
        this.Character.AnimationBlow();

        this.goGlasses.SetActive(false);
        this.goGlasses.SetActive(true);
    }
}
