/////////////////////////////////////////////////////////////////
/// EASY 2D SPRITES - HSV -1.2- by VETASOFT 2014
//////////////////////////////////////////////////////////

using UnityEngine;
using System.Collections;
#if UNITY_EDITOR
using UnityEditor;
#endif

[ExecuteInEditMode]
[AddComponentMenu ("Easy Sprites 2D/Hue Saturation Brightness")]

public class EasySprite_HSV : MonoBehaviour {
	
	[Range(0, 1)]
	public float _Alpha = 1f;
	[Range(0, 360)]
	public float _HueShift = 180f;
	public float _Saturation = 1f;
	public float _ValueBrightness = 1f;
	private Material tempMaterial;
	
	// Use this for initialization
	void Start () 
	{
		tempMaterial = new Material(Shader.Find("EasySprite2D/HSV_EasyS2D"));
 		GetComponent<Renderer>().sharedMaterial = tempMaterial;
		GetComponent<Renderer>().sharedMaterial.SetFloat("_Alpha", 1-_Alpha);
		GetComponent<Renderer>().sharedMaterial.SetFloat("_HueShift", _HueShift);
		GetComponent<Renderer>().sharedMaterial.SetFloat("_Sat", _Saturation);
		GetComponent<Renderer>().sharedMaterial.SetFloat("_Val", _ValueBrightness);
	}
	
	
	// Update is called once per frame
	void Update () 
	{
		#if UNITY_EDITOR
		if (Application.isPlaying!=true)
		{
			tempMaterial = new Material(Shader.Find("EasySprite2D/HSV_EasyS2D"));
			//if (renderer.sharedMaterial==null) renderer.sharedMaterial.shader=Shader.Find("Sprites/Default");
		//	tempMaterial = new Material(renderer.sharedMaterial);
		//	tempMaterial.shader = Shader.Find("EasySprite2D/HSV_EasyS2D");
			GetComponent<Renderer>().sharedMaterial = tempMaterial;
		}		
		#endif
		
		GetComponent<Renderer>().sharedMaterial.SetFloat("_Alpha", 1-_Alpha);
		GetComponent<Renderer>().sharedMaterial.SetFloat("_HueShift", _HueShift);
		GetComponent<Renderer>().sharedMaterial.SetFloat("_Sat", _Saturation);
		GetComponent<Renderer>().sharedMaterial.SetFloat("_Val", _ValueBrightness);
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
