<?php

namespace OC\PlatformBundle\Functions;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use \Doctrine\ORM\EntityManager;

class OCFunctions extends Bundle
{
	private $em;
	
	public function __construct(\Doctrine\ORM\EntityManager $em) {
		$this->em = $em;
	}

// 	public function __construct() {
// 		$this->em = new \Doctrine\ORM\EntityManager();
// 	}
	
	public function getRepository($entity) {
		return $this->em
		->getRepository('OCPlatformBundle:' . $entity)
		;
	}
	
	public function getEm() {
		return $this->em;
	}
}