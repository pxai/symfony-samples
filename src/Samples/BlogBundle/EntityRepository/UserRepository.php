<?php
// src/Samples/BlogBundle/EntityRepository/UserRepository.php

namespace Samples\BlogBundle\EntityRepository;

use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Doctrine\ORM\NoResultException;
use Doctrine\ORM\EntityRepository;

class UserRepository extends EntityRepository implements UserProviderInterface
{

	/*
	* implements method to get User from db using doctrine
	*/
	public function loadUserByUsername($username)
	{
		$q = $this
		->createQueryBuilder('u')
		->where('u.username = :username OR u.email = :email')
		->setParameter('username', $username)
		->setParameter('email', $username)
		->getQuery();
		
		try {
			// Exception is thornw
			$user = $q->getSingleResult();
		} catch (NoResultException $e) {
			throw new UsernameNotFoundException(sprintf('Unable to find an active admin'));
		}
		return $user;
		}

		public function refreshUser(UserInterface $user)
		{
			$class = get_class($user);
			if (!$this->supportsClass($class)) {
				throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', $class));
			}
			return $this->loadUserByUsername($user->getUsername());
		}


		public function supportsClass($class)
		{
			return $this->getEntityName() === $class || is_subclass_of($class, $this->getEntityName());
		}


	/**
	* customized function
	*
	*/
	public function findUsers()
	{
			return $this->findAll();
	}
}