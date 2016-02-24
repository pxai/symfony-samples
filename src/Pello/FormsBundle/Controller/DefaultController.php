<?php

namespace Pello\FormsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Pello\FormsBundle\Form\Type\UserType;
use Pello\FormsBundle\Entity\User;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('PelloFormsBundle:Default:index.html.twig');
    }

    public function simpleAction()
    {
    	$form = $this->createForm(new UserType());
        return $this->render('PelloFormsBundle:Default:simple.html.twig',array('form'=> $form->createView()));
    }

    public function simpleSaveAction(Request $request)
    {
    	$form = $this->createForm(new UserType(), new User());
    	if ($request->getMethod() == 'POST') {
    		$form->submit($request->request->get($form->getName()));
    		if ($form->isValid()) {
    			$user = $form->getData();
        		$response =  $this->render('PelloFormsBundle:Default:simpleSave.html.twig',array('user'=>$user));    			
    		} else {
    			$response = $this->render('PelloFormsBundle:Default:simple.html.twig', array('form'=> $form->createView()));
        	}
    	}

    	return $response;
    }

    public function localeAction($_locale='en_EN')
    {
    	//$locale = $this->get('session')->getLocale();
    	//$this->get('session')->set('_locale', $_locale);
        return $this->render('PelloFormsBundle:Default:index.html.twig', array('_locale'=>$_locale));
    }
}
