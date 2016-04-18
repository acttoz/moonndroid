﻿/////////////////////////////////////////////////////////////////
/// EASY 2D SPRITES - Outline -1.2- by VETASOFT 2014
//////////////////////////////////////////////////////////

using UnityEngine;
using System.Collections;
#if UNITY_EDITOR
using UnityEditor;
#endif

[ExecuteInEditMode]
[AddComponentMenu ("Easy Sprites 2D/Outline")]

public class EasySprite_Outline : MonoBehaviour {


	public Color _Color = new Color (1f, 1f, 1f, 1f);
	[Range(0.005f, 0.020f)]
	public float _OutLineSpread = 0.007f;

	Material tempMaterial;

	void Start () 
	{
		tempMaterial = new Material(Shader.Find("EasySprite2D/Outline_EasyS2D"));
		GetComponent<Renderer>().sharedMaterial = tempMaterial;
		GetComponent<Renderer>().sharedMaterial.SetColor("_Color", _Color);
		GetComponent<Renderer>().sharedMaterial.SetFloat("_OutLineSpread", _OutLineSpread);
	}

	void Update () 
	{
		#if UNITY_EDITOR
		if (Application.isPlaying!=true)
		{
			tempMaterial = new Material(Shader.Find("EasySprite2D/Outline_EasyS2D"));
			GetComponent<Renderer>().sharedMaterial = tempMaterial;
		}
		#endif

		GetComponent<Renderer>().sharedMaterial.SetColor("_Color", _Color);
		GetComponent<Renderer>().sharedMaterial.SetFloat("_OutLineSpread", _OutLineSpread);

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
