<?php

namespace  Samples\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Samples\BlogBundle\Entity\Comment;
use Samples\BlogBundle\Form\Type\CommentType;

class CommentController extends Controller
{



    /**
    *
    *
    */
    public function newCommentSaveAction(Request $request)
    {
        $form = $this->createForm(new CommentType());
        if ($request->getMethod() == 'POST') {
            //$form->bind($request);
            $form->submit($request->request->get($form->getName()));
            $comment = $form->getData();
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getEntityManager();
                $em->merge($comment);
                $em->flush();
                $response = $this->forward('SamplesBlogBundle:Post:detail', array('id' => $comment->getPost()->getId()));
            } else {
                $post = $this->getDoctrine()->getRepository("SamplesBlogBundle:Post")->find($comment->getPost()->getId());
                //$response = $this->forward('SamplesBlogBundle:Post:detail', array('id' => 1,'formComment'=> $form->createView()));
                $response = $this->render('SamplesBlogBundle:Default:detail.html.twig', array('post' => $post,'form'=> $form->createView()));
            }
        }

        return $response;
    }


    /**
    *
    *
    */
    public function updateCommentAction($id) {
        $comment = $this->getDoctrine()->getRepository("SamplesBlogBundle:Comment")->find($id);
      
        $form = $this->createForm(new CommentType(), $comment);

        return $this->render('SamplesBlogBundle:Default:updateComment.html.twig',array('form'=> $form->createView(),'id'=>$id));
    }
    
    /**
    *
    *
    */
    public function updateCommentSaveAction(Request $request) {
      
        $form = $this->createForm(new CommentType(), new Comment());
        $form->submit($request->request->get($form->getName()));
        if ($request->getMethod() == 'POST') {
            $comment = $form->getData();
            if ($form->isValid()) {
                
                $em = $this->getDoctrine()->getEntityManager();
                $em->merge($comment);
                $em->flush();
                
                // redirect to index
                $response = $this->forward('SamplesBlogBundle:Post:detail', array('id' => $comment->getPost()->getId()));
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
   public function deleteCommentAction($id=1)
    {
        $comment = $this->getDoctrine()->getRepository("SamplesBlogBundle:Comment")->find($id);
        return $this->render('SamplesBlogBundle:Default:deleteComment.html.twig',array('comment'=> $comment));
    }

    /**
    *
    *
    */
   public function deleteCommentSaveAction(Comment $comment)
    {
        $postId = $comment->getPost()->getId();
       $em = $this->getDoctrine()->getEntityManager();
       $em->remove($comment);
       $em->flush();
        return $this->forward('SamplesBlogBundle:Post:detail', array('id' => $postId));
       //return $this->forward('SamplesBlogBundle:Post:index');
    }

}
