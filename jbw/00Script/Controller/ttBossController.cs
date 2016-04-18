using UnityEngine;
using System.Collections;

public class ttBossController : MonoBehaviour {

    public ttMonsterController Monster;

    float startPosX = 14f;
    float endPosX = 15f;
    float speed = 2f;   // 낮을수록 빠르다.

    int health = 3;
    int max_health = 3;
    float healthbar_offsetX = 20f;

    public int Health
    {
        get { return health; }
        set 
        {
            health = (value < 0) ? 0 : value;
            HealthBar.transform.localScale = new Vector3((float)health / max_health * healthbar_offsetX, 3, 1);
        }
    }

    public GameObject HealthBar;

    public bool hit;



    public void OnTriggerEnter(Collider other)
    {
        if (other.tag == "Player" && this.hit == false)
        {
            this.hit = true;
            ttGameManager.i.CheckGradeFromBoss();
        }
    }

    public void MoveRight()
    {
        TweenPosition.Begin(this.gameObject, speed, Vector3.right * endPosX);
    }

    public void ResetPosition()
    {
        transform.position = new Vector3(startPosX, 0, 0);
    }

    public void Reset()
    { 
        Health = max_health;

        Monster.arm.CrossFade("Mon_arm_idle");
        Monster.item.CrossFade("Mon_item_idle");
    }

    public void OnDamage()
    {
        this.Health--;

        if (Health == 2)
        {
			TweenPosition.Begin(this.gameObject, 0.2f, Vector3.right* 14f);
			Monster.item.CrossFade("Mon_defeat");
            Monster.item2.CrossFade("Mon_defeat");
            this.MakeFxRuptureOnItem();
        }

        if (Health == 1)
        {
			TweenPosition.Begin(this.gameObject, 0.2f, Vector3.right* 14f);
			Monster.arm.CrossFade("Mon_defeat");
            Monster.arm2.CrossFade("Mon_defeat");
            this.MakeFxRuptureOnArm();
        }

        if(Health <= 0)
        {
            ttGameManager.i.OnEndLevel();
        }
    }


    public void MakeFxHit()
    {
        Instantiate(Monster.fxHit, transform.position, Quaternion.identity);
    }

    public void MakeFxRuptureOnItem()
    {
		GameObject itemTemp = Instantiate (Monster.fxRupture, Monster.item.transform.position, Quaternion.identity) as GameObject;
		GameObject itemTemp2 = Instantiate (Monster.fxRupture, Monster.item2.transform.position, Quaternion.identity) as GameObject;
		itemTemp.transform.parent = Monster.item.transform;
		itemTemp2.transform.parent = Monster.item2.transform;
    }

    public void MakeFxRuptureOnArm()
    {

		GameObject armTemp = Instantiate (Monster.fxRupture, Monster.arm.transform.position, Quaternion.identity) as GameObject;
		GameObject armTemp2 = Instantiate (Monster.fxRupture, Monster.arm2.transform.position, Quaternion.identity) as GameObject;
		armTemp.transform.parent = Monster.arm.transform;
		armTemp2.transform.parent = Monster.arm2.transform;
    }
}
