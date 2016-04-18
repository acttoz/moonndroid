using UnityEngine;
using System.Collections;

public class DrawLine : MonoBehaviour {
	Vector3[] nodes;
	public Component lineComponent;
	// Use this for initialization
	void Start () {
		nodes = iTweenPath.GetPath ("path");
	}
	
	// Update is called once per frame
	void Update () {
	
	}
}
