using UnityEngine;
using System.Collections;

public class ttInputManager : MonoBehaviour {

    ttGameManager gameMgr;

	// Use this for initialization
	void Start () {

        gameMgr = this.GetComponent<ttGameManager>();
	}
	
	// Update is called once per frame
	void Update () {

        if (Input.GetMouseButtonDown(0))
        {
            gameMgr.OnClickTouchPoint();
        }
	}
}
