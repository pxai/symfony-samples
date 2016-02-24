<?php
// src/Samples/BlogBundle/EntityRepository/CommentRepository.php

namespace Samples\BlogBundle\EntityRepository;
use Doctrine\ORM\EntityRepository;

class CommentRepository extends EntityRepository
{

	/**
	* customized function
	*
	*/
	public function findComments($post_id=0)
	{
			return $this->findAll();
	}
}