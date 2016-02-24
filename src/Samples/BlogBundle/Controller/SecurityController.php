<?php

namespace  Samples\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContext;
use Samples\BlogBundle\Entity\User;
use Samples\BlogBundle\Form\Type\UserType;

class SecurityController extends Controller
{


    public function loginAction()
    {
         $form = $this->createForm(new UserType(),new User());
         $request = $this->getRequest();
         $session = $request->getSession();

/*        
        
        $form->bind($request);       */ 
        // obtiene el error de inicio de sesión si lo hay
        if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
        } else {
            $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
            $session->remove(SecurityContext::AUTHENTICATION_ERROR);
        }

        return $this->render('SamplesBlogBundle:Default:login.html.twig', array(
        // el último nombre de usuario ingresado por el usuario
            'last_username' => $session->get(SecurityContext::LAST_USERNAME),
            'error'=> $error,
            'form' => $form->createView()
        ));
   }



    public function customLoginCheckAction(Request $request)
    {
        $form = $this->createForm(new UserType(),new User());
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
                $response = $this->render('SamplesBlogBundle:Default:login.html.twig', array('form'=>$form->createView()));
            }
        }

        return $response;
    }


}
