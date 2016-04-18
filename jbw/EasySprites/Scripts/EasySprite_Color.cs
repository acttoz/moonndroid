﻿////////////////////////////////////////////////////////////////
/// EASY 2D SPRITES - Color  -1.2- by VETASOFT 2014
/////////////////////////////////////////////////////////////////

using UnityEngine;
using System.Collections;
#if UNITY_EDITOR
using UnityEditor;
#endif

[ExecuteInEditMode]
[AddComponentMenu ("Easy Sprites 2D/One Color")]
public class EasySprite_Color : MonoBehaviour {

	public Color _Color = new Color (1f, 1f, 1f, 1f);
	[Range(0, 1)]
	public float _Alpha = 1f;
	Material tempMaterial;

	void Start () 
	{
		tempMaterial = new Material(Shader.Find("EasySprite2D/Color_EasyS2D"));
		GetComponent<Renderer>().sharedMaterial = tempMaterial;
		GetComponent<Renderer>().sharedMaterial.SetFloat("_Alpha", 1-_Alpha);
		GetComponent<Renderer>().sharedMaterial.SetColor("_Color", _Color);
	}

	void Update () 
	{
		#if UNITY_EDITOR
		if (Application.isPlaying!=true)
		{
			tempMaterial = new Material(Shader.Find("EasySprite2D/Color_EasyS2D"));
			GetComponent<Renderer>().sharedMaterial = tempMaterial;
		}		
		#endif

		GetComponent<Renderer>().sharedMaterial.SetFloat("_Alpha", 1-_Alpha);
		GetComponent<Renderer>().sharedMaterial.SetColor("_Color", _Color);
	}

	void OnDestroy()
	{
		if ((Application.isPlaying == false) && (Application.isEditor == true) && (Application.isLoadingLevel == false))
			GetComponent<Renderer>().sharedMaterial.shader=Shader.Find("Sprites/Default");
		
	}
	void OnDisable()
	{
		GetComponent<Renderer>().sharedMaterial.shader=Shader.Find("Sprites/Default");
	}
	
	void OnEnable()
	{
		Start ();
	}
}
