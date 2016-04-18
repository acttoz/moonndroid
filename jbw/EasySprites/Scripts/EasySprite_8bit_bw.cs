////////////////////////////////////////////////////////////////
/// EASY 2D SPRITES - 8 Bits Black & White  -1.2- by VETASOFT 2014
/////////////////////////////////////////////////////////////////

using UnityEngine;
using System.Collections;
#if UNITY_EDITOR
using UnityEditor;
#endif

[ExecuteInEditMode]
[AddComponentMenu ("Easy Sprites 2D/8 Bits - Black & White")]
public class EasySprite_8bit_bw : MonoBehaviour {


	[Range(0, 1)]
	public float _Alpha = 1f;
	[Range(0f, 10f)]
	public float _Size = 1f;
	[Range(0f, 10f)]
	public float _Offset = 1f;
	[Range(0f, 10f)]
	public float _Offset2 = 1f;
	Material tempMaterial;

	void Start () 
	{
		tempMaterial = new Material(Shader.Find("EasySprite2D/8BitBW_EasyS2D"));
		GetComponent<Renderer>().sharedMaterial = tempMaterial;
		GetComponent<Renderer>().sharedMaterial.SetFloat("_Alpha", 1-_Alpha);
		GetComponent<Renderer>().sharedMaterial.SetFloat("_Size", _Size);
		GetComponent<Renderer>().sharedMaterial.SetFloat("_Offset", _Offset);
		GetComponent<Renderer>().sharedMaterial.SetFloat("_Offset2", _Offset2);
	}

	void Update () 
	{
		#if UNITY_EDITOR
		if (Application.isPlaying!=true)
		{
			tempMaterial = new Material(Shader.Find("EasySprite2D/8BitBW_EasyS2D"));
			GetComponent<Renderer>().sharedMaterial = tempMaterial;
		}
		#endif

		GetComponent<Renderer>().sharedMaterial.SetFloat("_Alpha", 1-_Alpha);
		GetComponent<Renderer>().sharedMaterial.SetFloat("_Size", _Size);
		GetComponent<Renderer>().sharedMaterial.SetFloat("_Offset", _Offset);
		GetComponent<Renderer>().sharedMaterial.SetFloat("_Offset2", _Offset2);

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
