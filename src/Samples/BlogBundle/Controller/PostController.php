<?php

namespace  Samples\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Samples\BlogBundle\Entity\Post;
use Samples\BlogBundle\Entity\Comment;
use Samples\BlogBundle\Form\Type\PostType;
use Samples\BlogBundle\Form\Type\CommentType;

class PostController extends Controller
{
    /**
    *
    *
    */
    public function indexAction()
    {
        //$posts = $this->getDoctrine()->getRepository("SamplesBlogBundle:Post")->findAll();
        $posts = $this->getDoctrine()->getRepository("SamplesBlogBundle:Post")->findPosts();
        return $this->render('SamplesBlogBundle:Default:index.html.twig', array('posts'=>$posts));
    }

    /**
    *
    *
    */
   public function newPostAction()
    {
        $form = $this->createForm(new PostType());
        return $this->render('SamplesBlogBundle:Default:newPost.html.twig',array('form'=> $form->createView()));
    }

    /**
    *
    *
    */
    public function newPostSaveAction(Request $request)
    {
        $form = $this->createForm(new PostType(), new Post());
        if ($request->getMethod() == 'POST') {
            //$form->bind($request);
            $form->submit($request->request->get($form->getName()));
            if ($form->isValid()) {
                $post = $form->getData();

                $em = $this->getDoctrine()->getEntityManager();
                $em->merge($post);
                $em->flush();
                $response =  $this->render('SamplesBlogBundle:Default:newPostSave.html.twig', array('post' => $post));               
            } else {
                $response = $this->render('SamplesBlogBundle:Default:newPost.html.twig', array('form'=> $form->createView()));
            }
        }

        return $response;
    }

    /**
    *
    *
    */
   public function detailAction($id=1)
    {

        $post = $this->getDoctrine()->getRepository("SamplesBlogBundle:Post")->find($id);
        
        $comment = new Comment();
        $comment->setPost($post);

        $form = $this->createForm(new CommentType(),$comment);
        return $this->render('SamplesBlogBundle:Default:detail.html.twig',array('post'=> $post,'form'=>$form->createView()));
    }

    /**
    *
    *
    */
    public function updatePostAction($id) {
        $post = $this->getDoctrine()->getRepository("SamplesBlogBundle:Post")->find($id);
      
        $form = $this->createForm(new PostType(), $post);

        return $this->render('SamplesBlogBundle:Default:updatePost.html.twig',array('form'=> $form->createView(),'id'=>$id));
    }
    
    /**
    *
    *
    */
    public function updatePostSaveAction(Request $request) {
      
        $form = $this->createForm(new PostType(), new Post());
        $form->submit($request->request->get($form->getName()));
        if ($request->getMethod() == 'POST') {
            if ($form->isValid()) {
                $post = $form->getData();
                
                $em = $this->getDoctrine()->getEntityManager();
                $em->merge($post);
                $em->flush();
                
                // redirect to index
                $response = $this->forward('SamplesBlogBundle:Post:detail', array('id' => $post->getId()));
            } else  {
                 $response = $this->render('SamplesBlogBundle:Default:updatePost.html.twig', array('form'=> $form->createView()));
            }
        }
        return $response;
    }

    /**
    *
    *
    */
   public function deletePostAction($id=1)
    {
        $post = $this->getDoctrine()->getRepository("SamplesBlogBundle:Post")->find($id);
        return $this->render('SamplesBlogBundle:Default:delete.html.twig',array('post'=> $post));
    }

    /**
    *
    *
    */
   public function deletePostSaveAction(Post $post)
    {

       $em = $this->getDoctrine()->getEntityManager();
       $em->remove($post);
       $em->flush();
       return $this->forward('SamplesBlogBundle:Post:index');
    }

}
