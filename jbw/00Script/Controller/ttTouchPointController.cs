using UnityEngine;
using System.Collections;

public class ttTouchPointController : MonoBehaviour {

    public GameObject goBeam;
    float startPosX = 0f;
    float endPosX = 150f;//moon// 
    float speed = 1.5f;       //낮을수록 빠르다.
	Vector3 height;

    public bool isPassing = false;


	//moon//프로토타입용 -------------
	public void setSpeed(float amount)
	{
		speed = amount;
	}
	//moon//프로토타입용 ------------

	//moon//프로토타입용 -------------
	public void setHeight(float amount)
	{
		height = new Vector3 (goBeam.transform.localScale.x, amount, 0);
	}
	//moon//프로토타입용 ------------



    public void OnTriggerStay(Collider other)
    {
        if (other.tag == "Player" && ttGameManager.i.gameState != GameStatus.END)
        {
            if (!isPassing)
            {
				goBeam.SetActive (false);
                isPassing = true;
                ttGameManager.i.TransformHero();
            }
        }
    }

    public void OnTriggerExit(Collider other)
    {
        if (other.tag == "Player")
        {
            if (isPassing)
            {
                isPassing = false;
            }
        }
    }

    public void MoveBeamUp()
    {
        TweenPosition.Begin(this.goBeam, speed, Vector3.up * endPosX);
    }

    public void ResetBeam()
    {
        if (goBeam.GetComponent<TweenPosition>())
        {
			goBeam.transform.localScale = height;
			goBeam.SetActive (true);
            goBeam.GetComponent<TweenPosition>().enabled = false;
            goBeam.transform.localPosition = Vector3.zero;
        }
    }
}
