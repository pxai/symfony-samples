<?php

namespace Samples\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;
use Symfony\Component\Security\Core\User\EquatableInterface; # TODO: check, maybe not necessary
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="Samples\BlogBundle\EntityRepository\UserRepository")
 * @ORM\Table(name="user")
 * It must be advancedUserInterface in order to support roles in db
 */
class User implements AdvancedUserInterface
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
    private $username;
    
     /**
     * @ORM\Column(type="text")
     */
    private $password;

  /**
  * @ORM\Column(type="string", length=32)
  */
  private $salt;

  /**
  * @ORM\Column(name="is_active", type="boolean")
  */
  private $isActive;

    /**
     * @ORM\Column(type="text")
     */
    private $email;

    /** @ORM\OneToMany(targetEntity="Comment", mappedBy="user") */
    private $comments;

    /**
    * @ORM\ManyToMany(targetEntity="Role", mappedBy="users")
    */
    private $roles;


    public function __construct () {
      $this->isActive = true;
      $this->salt = md5(uniqid(null, true));
      $this->comments = new ArrayCollection();
      $this->roles = new ArrayCollection;
    }

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
        return $this;
    }

    
    /**
    *
    */
    public function getUsername () {
      return $this->username;  
    }
    
    /**
    *
    */
    public function setUsername ($username) {
        $this->username = $username;
        return $this;
    }
    
    
    /**
    * @inheritDoc
    */
    public function getPassword() {
      return $this->password;  
    }
    
    /**
    *
    */
    public function setPassword ($password) {
        $this->password = $password;
        return $this;
    }

    /**
    *
    */
    public function getEmail() {
      return $this->email;  
    }
    
    /**
    *
    */
    public function setEmail ($email) {
        $this->email = $email;
        return $this;
    }

    /**
    * @inheritDoc
    */
    public function getSalt()
    {
      return $this->salt;
    }


  /**
  * @inheritDoc
  */
  public function eraseCredentials()
  {
  }

    public function isEqualTo(UserInterface $user)
    {
      return $this->username === $user->getUsername();
    }

    /**
    *
    */
    public function getComments() {
      return $this->comments;  
    }
    
    /**
    *
    */
    public function setComments(ArrayCollection $comments) {
        $this->comments = $comments;
        return $this;
    }

    /**
    * @inheritDoc
    */
    public function getRoles()
    {
      //return array('ROLE_USER','ROLE_ADMIN');
      return $this->roles;
    }

    /**
    * Advanced user interface implements
    */
    public function isAccountNonExpired()
    {
      return true;
    }

    public function isAccountNonLocked()
    {
      return true;
    }

    public function isCredentialsNonExpired()
    {
      return true;
    }
    
    public function isEnabled() {
      return true;
    }
}