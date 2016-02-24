<?php

namespace  Samples\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->forward('SamplesBlogBundle:Post:index');
    }


    public function localeAction($_locale='en_EN')
    {
    	//$locale = $this->get('session')->getLocale();
    	//$this->get('session')->set('_locale', $_locale);
        return $this->render('SamplesBlogBundle:Default:index.html.twig', array('_locale'=>$_locale));
    }
}
