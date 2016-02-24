<?php

namespace Pello\CustomerCrudBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="customer")
 */
class Customer
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
     /**
     * @ORM\Column(type="string", length=50)
     */
    private $name;
    
     /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
    *
    */
    public function getId () {
      return $this->id;  
    }
    
    /**
    *
    */
    public function setId ($id) {
        $this->id = $id;
    }

    
    /**
    *
    */
    public function getName () {
      return $this->name;  
    }
    
    /**
    *
    */
    public function setName ($name) {
        $this->name = $name;
    }
    
    
    /**
    *
    */
    public function getDescription() {
      return $this->description;  
    }
    
    /**
    *
    */
    public function setDescription ($description) {
        $this->description = $description;
    }
}