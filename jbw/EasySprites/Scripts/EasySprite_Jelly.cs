﻿/////////////////////////////////////////////////////////////////
/// EASY 2D SPRITES - Wave -1.2- by VETASOFT 2014
//////////////////////////////////////////////////////////

using UnityEngine;
using System.Collections;
#if UNITY_EDITOR
using UnityEditor;
#endif

[ExecuteInEditMode]
[AddComponentMenu ("Easy Sprites 2D/Jelly")]

public class EasySprite_Jelly : MonoBehaviour {


	[Range(0, 1)]
	public float _Alpha = 1f;
	[Range(0f, 128f)]
	public float _OffsetX = 3.9f;
	[Range(0f, 128f)]
	public float _OffsetY = 3.1f;
	[Range(0f, 0.05f)]
	public float _DistanceX = 0.05f;
	[Range(0f, 0.05f)]
	public float _DistanceY = 0.05f;
	[Range(0f, 6.28f)]
	public float _WaveTimeX = 1.68f;
	[Range(0f, 6.28f)]
	public float _WaveTimeY = 1.68f;
	[Range(0, 1)]
	public float _AlphaIn = 1f;

	public bool AutoPlayWaveX=false;
	[Range(0f, 50f)]
	public float AutoPlaySpeedX=5f;
	public bool AutoPlayWaveY=false;
	[Range(0f, 50f)]
	public float AutoPlaySpeedY=5f;


	Material tempMaterial;

	void Start () 
	{
		tempMaterial = new Material(Shader.Find("EasySprite2D/Jelly_EasyS2D"));
		GetComponent<Renderer>().sharedMaterial = tempMaterial;

		GetComponent<Renderer>().sharedMaterial.SetFloat("_Alpha", 1-_Alpha);
		GetComponent<Renderer>().sharedMaterial.SetFloat("_OffsetX", _OffsetX);
		GetComponent<Renderer>().sharedMaterial.SetFloat("_OffsetY", _OffsetY);
		GetComponent<Renderer>().sharedMaterial.SetFloat("_DistanceX", _DistanceX);
		GetComponent<Renderer>().sharedMaterial.SetFloat("_DistanceY", _DistanceY);
		GetComponent<Renderer>().sharedMaterial.SetFloat("_WaveTimeX", _WaveTimeX);
		GetComponent<Renderer>().sharedMaterial.SetFloat("_WaveTimeY", _WaveTimeY);
		GetComponent<Renderer>().sharedMaterial.SetFloat("_AlphaIn", _AlphaIn);
	}

	void Update () 
	{
		#if UNITY_EDITOR
		if (Application.isPlaying!=true)
		{
			tempMaterial = new Material(Shader.Find("EasySprite2D/Jelly_EasyS2D"));
			GetComponent<Renderer>().sharedMaterial = tempMaterial;
		}
		#endif

		GetComponent<Renderer>().sharedMaterial.SetFloat("_Alpha", 1-_Alpha);
		GetComponent<Renderer>().sharedMaterial.SetFloat("_OffsetX", _OffsetX);
		GetComponent<Renderer>().sharedMaterial.SetFloat("_OffsetY", _OffsetY);
		GetComponent<Renderer>().sharedMaterial.SetFloat("_DistanceX", _DistanceX);
		GetComponent<Renderer>().sharedMaterial.SetFloat("_DistanceY", _DistanceY);
		GetComponent<Renderer>().sharedMaterial.SetFloat("_WaveTimeX", _WaveTimeX);
		GetComponent<Renderer>().sharedMaterial.SetFloat("_WaveTimeY", _WaveTimeY);
		GetComponent<Renderer>().sharedMaterial.SetFloat("_AlphaIn", _AlphaIn);
		if (AutoPlayWaveX) _WaveTimeX += AutoPlaySpeedX * Time.deltaTime;
		if (AutoPlayWaveY) _WaveTimeY += AutoPlaySpeedY * Time.deltaTime;
		if (_WaveTimeX > 6.28f) _WaveTimeX = 0f;
		if (_WaveTimeY > 6.28f) _WaveTimeY = 0f;

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
