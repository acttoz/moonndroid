/////////////////////////////////////////////////////////////////
/// EASY 2D SPRITES - PlasmaShield -1.3- by VETASOFT 2014
//////////////////////////////////////////////////////////

using UnityEngine;
using System.Collections;
#if UNITY_EDITOR
using UnityEditor;
#endif

[ExecuteInEditMode]
[AddComponentMenu ("Easy Sprites 2D/Plasma Shield")]
public class EasySprite_PlasmaShield : MonoBehaviour {


	[Range(0, 1)]
	public float _Alpha = 1f;
	[Range(0.1f, 8f)]
	public float _Size = 6f;
	[Range(0.1f, 4f)]
	public float _Offset = 2.5f;
	public Color _Color = new Color (1f, 1f, 1f, 1f);
	private float _TimeX = 0;
	[Range(0, 3)]
	public float Speed = 1;


	Material tempMaterial;

	void Start () 
	{
		tempMaterial = new Material(Shader.Find("EasySprite2D/PlasmaShield"));
		GetComponent<Renderer>().sharedMaterial = tempMaterial;
		GetComponent<Renderer>().sharedMaterial.SetFloat("_Alpha", 1-_Alpha);
		GetComponent<Renderer>().sharedMaterial.SetFloat("_Size", _Size);
		GetComponent<Renderer>().sharedMaterial.SetFloat("_Offset", _Offset);
		GetComponent<Renderer>().sharedMaterial.SetColor("_Color", _Color);
		_TimeX+=Time.deltaTime*Speed;
		if (_TimeX>100)  _TimeX=0;
		GetComponent<Renderer>().sharedMaterial.SetFloat("_TimeX", _TimeX);
	}

	void Update () 
	{
		#if UNITY_EDITOR
		if (Application.isPlaying!=true)
		{
			tempMaterial = new Material(Shader.Find("EasySprite2D/PlasmaShield"));
			GetComponent<Renderer>().sharedMaterial = tempMaterial;
		}
		#endif

		GetComponent<Renderer>().sharedMaterial.SetFloat("_Alpha", 1-_Alpha);
		GetComponent<Renderer>().sharedMaterial.SetFloat("_Size", _Size);
		GetComponent<Renderer>().sharedMaterial.SetFloat("_Offset", _Offset);
		GetComponent<Renderer>().sharedMaterial.SetColor("_Color", _Color);
		_TimeX+=Time.deltaTime*Speed;
		if (_TimeX>100)  _TimeX=0;
		GetComponent<Renderer>().sharedMaterial.SetFloat("_TimeX", _TimeX);

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
