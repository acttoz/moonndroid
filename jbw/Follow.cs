using UnityEngine;
using System.Collections;

public class Follow : MonoBehaviour {

	float percentsPerSecond = 0.2f; // %2 of the path moved per second
	float currentPathPercent = 0.0f; //min 0, max 1
	int path=0;

	void Update () 

	{
	}

	void Start(){
		pathMove1 ();

	}

	void pathMove1(){
			iTween.MoveTo (gameObject, iTween.Hash ("path", iTweenPath.GetPath ("1"),"delay",0, "time",1f,"oncomplete","pathMove2", "easetype", iTween.EaseType.linear ));

	}
	void pathMove2(){
		iTween.MoveTo (gameObject, iTween.Hash ("path", iTweenPath.GetPath ("2"), "delay",0,"time",1f,  "easetype", iTween.EaseType.linear ));

	}
	void path2(){
		
	}
	 


}
