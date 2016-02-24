<?php

namespace Pello\CustomerCrudBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Pello\CustomerCrudBundle\Entity\Customer;
use Pello\CustomerCrudBundle\Form\Type\CustomerType;

class DefaultController extends Controller
{
    private $customers = array();
    
    
    function __construct() {
        //apc_clear_cache();
        $this->customers[] = array('id'=>1,'name'=> 'Juan');
        $this->customers[] = array('id'=>2,'name'=> 'Pedro');
    }
   
    public function indexAction()
    {
        $customers = $this->getDoctrine()->getRepository("PelloCustomerCrudBundle:Customer")->findAll();
        return $this->render('PelloCustomerCrudBundle:Default:index.html.twig', array('customers'=>$customers));
    }
    
    public function otherAction($name,$number=4)
    {
        $result = "";
        for ($i=0;$i<$number;$i++) {
            $result .= $name;
        }
        return $this->render('PelloCustomerCrudBundle:Default:index.html.twig', array('name' => $result));
    }
    
    public function newAction()
    {
        return $this->render('PelloCustomerCrudBundle:Default:new.html.twig');
    }
    
    public function savenewAction(Request $request) {

        $customer = new Customer();
        $customer->setName($request->request->get('name'));
        $customer->setDescription($request->request->get('description'));
        
        $validator = $this->get('validator');
        $errors = $validator->validate($customer);
        
        if (count($errors) > 0) {
            $response = $this->render('PelloCustomerCrudBundle:Default:new.html.twig', array('errors' => $errors));
        } else {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($customer);
            $em->flush();
            
            // redirect to index
            $response = $this->forward('PelloCustomerCrudBundle:Default:index',array('errors' => $errors));
        }
        return $response;
    }
    
    
    public function updateAction($id) {
      $customer = $this->getDoctrine()->getRepository("PelloCustomerCrudBundle:Customer")->find($id);
      
      /**
       * by hand
        $form = $this->createFormBuilder($customer)
                ->add('id','hidden')
                ->add('name','text')
                ->add('description','textarea')
                ->getForm();
         */     
        $form = $this->createForm(new CustomerType(), $customer);

        return $this->render('PelloCustomerCrudBundle:Default:update.html.twig',array('form'=> $form->createView(),'id'=>$id));
    }
    
    public function saveupdateAction(Request $request) {

        $customer = new Customer();
       /**
        * old way to deal by hand
        * $customer->setId($request->request->get('id'));
        $customer->setName($request->request->get('name'));
        $customer->setDescription($request->request->get('description'));*/
        
        $form = $this->createForm(new CustomerType(), new Customer());
        $form->submit($request->request->get($form->getName()));
        if ($form->isValid()) {
            $customer = $form->getData();
            
            $em = $this->getDoctrine()->getEntityManager();
            $em->merge($customer);
            $em->flush();
            
            // redirect to index
            $response = $this->forward('PelloCustomerCrudBundle:Default:index');
        } else  {
             $response = $this->render('PelloCustomerCrudBundle:Default:update.html.twig', array('form'=> $form->createView()));
        }
        return $response;
    }
    
    
    public function detailAction($id=1)
    {
        $customer = new Customer();
        $customer->setName('MyCustom');
        $customer->setDescription('This is the customer');
     /*   
        $em = $this->getDoctrine()->getEntityManager();
        $em->persist($customer);
        $em->flush();
        */
        
        $customer = $this->getDoctrine()->getRepository("PelloCustomerCrudBundle:Customer")->find($id);
        
        
        
//        return $this->render('PelloCustomerCrudBundle:Default:detail.html.twig',array('customer'=>$this->customers[0]));
        return $this->render('PelloCustomerCrudBundle:Default:detail.html.twig',array('customer'=>$customer,'id'=>$id));
    }
    
     public function deleteAction(Customer $customer)
    {
       
        $em = $this->getDoctrine()->getEntityManager();
        $em->remove($customer);
        $em->flush();
        

        // redirect to index
        $response = $this->forward('PelloCustomerCrudBundle:Default:index');
        return $response;
    }
}
