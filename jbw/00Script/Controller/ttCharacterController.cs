using UnityEngine;
using System.Collections;

public class ttCharacterController : MonoBehaviour {

    SpriteRenderer sRenderer;
    public Sprite[] arraySprite;

    public GameObject fxHit;
    public GameObject fxTransform;

    public AudioSource characterAudio; 
   
    public AudioClip sfxTransform;
    public AudioClip sfxPunchShort;

    Animation ani;


    public void Awake()
    {
        sRenderer = this.GetComponent<SpriteRenderer>();
        characterAudio = this.GetComponent<AudioSource>();
        ani = this.GetComponent<Animation>();
    }

    public void ChangeSprite(int index)
    {
        if (this.arraySprite.Length < index+1)
        {
            Debug.Log("no sprite");
            return;
        }

        ani.CrossFade("Hero_Trans");
        ani.Rewind();
        ani.Play();
        sRenderer.sprite = arraySprite[index];
    }

	public void flipSprite(bool isFlipY){
		sRenderer.flipY = isFlipY;
		ani.Rewind();
		ani.Play();
	}

    public void AnimationIdle()
    {
        ani.CrossFade("Hero_Idle");
    }

    public void AnimationBlow()
    {
        ani.CrossFade("Hero_dizzy");
    }
}
