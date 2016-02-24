<?php

namespace Pello\FormsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="customer")
 */
class User
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
    private $login;
    
     /**
     * @ORM\Column(type="text")
     */
    private $password;

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
    public function getLogin () {
      return $this->login;  
    }
    
    /**
    *
    */
    public function setLogin ($login) {
        $this->login = $login;
    }
    
    
    /**
    *
    */
    public function getPassword() {
      return $this->password;  
    }
    
    /**
    *
    */
    public function setPassword ($password) {
        $this->password = $password;
    }
}