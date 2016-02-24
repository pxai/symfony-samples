<?php

namespace Samples\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="Samples\BlogBundle\EntityRepository\PostRepository")
 * @ORM\Table(name="post")
 */
class Post
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
     /**
     * @ORM\Column(name="title",type="string", length=50)
     */
    private $title;
  
  /**
  * @var Category
  * @ORM\ManyToOne(targetEntity="Category")
  * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
  */
    private $category;

     /**
     * @ORM\Column(name="text",type="text")
     */
    private $text;

     /**
     * @ORM\Column(name="post_date",type="datetime")
     */
    private $postDate;

    /** 
      * @ORM\ManyToOne(targetEntity="User") 
      * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
      */
    private $user;


    /** @ORM\OneToMany(targetEntity="Comment", mappedBy="post") */
    private $comments;


    public function __construct () {
      $this->comments = new ArrayCollection();
      $user = new User();
      $user->setId(1);
      $this->setUser($user);
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
    public function getTitle () {
      return $this->title;  
    }
    
    /**
    *
    */
    public function setTitle ($title) {
        $this->title = $title;
        return $this;
    }
    
        /**
    *
    */
    public function getCategory () {
      return $this->category;  
    }
    
    /**
    *
    */
    public function setCategory ($category) {
        $this->category = $category;
        return $this;
    }
    
    /**
    *
    */
    public function getText() {
      return $this->text;  
    }
    
    /**
    *
    */
    public function setText ($text) {
        $this->text = $text;
        return $this;
    }

    /**
    *
    */
    public function getPostDate() {
      return $this->postDate;  
    }
    
    /**
    *
    */
    public function setPostDate ($postDate) {
        $this->postDate = $postDate;
        return $this;
    }

        /**
    *
    */
    public function getUser() {
      return $this->user;  
    }
    
    /**
    *
    */
    public function setUser($user) {
        $this->user = $user;
        return $this;
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
        return $this
    }
}