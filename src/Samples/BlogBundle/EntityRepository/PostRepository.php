<?php
// src/Samples/BlogBundle/EntityRepository/PostRepository.php

namespace Samples\BlogBundle\EntityRepository;
use Doctrine\ORM\EntityRepository;

class PostRepository extends EntityRepository
{

	/**
	* customized function
	*
	*/
	public function findPosts()
	{
			return $this->findAll();
	}
}