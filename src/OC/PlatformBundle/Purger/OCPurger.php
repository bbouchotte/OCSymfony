<?php

namespace OC\PlatformBundle\Purger;

use Doctrine\Bundle\DoctrineBundle\Registry;
use OC\PlatformBundle\Entity\Advert;
use Symfony\Component\Validator\Constraints\Count;

class OCPurger {
	
	/**
	 * @var Symfony\Bundle\DoctrineBundle\Registry
	 */
	private $doctrine;
	
	private $em;
	
	public function __construct(Registry $doctrine) {
		$this->doctrine = $doctrine;
		$this->em = $this->doctrine->getManager();
	}

	public function purge($days) {
		
		$em = $this->em;
		
		$adverts = $em->getRepository('OCPlatformBundle:Advert')
			->findByDays($days)
		;
		
		// on boucle sur les annonces
		foreach ($adverts as $advert)
		{
			// un cascade={"remove"} dans Advert.php évite de boucler sur les compétences
			
			$em->remove($advert);
		}
		
		$em->flush();
		$count = count($adverts);
		
		return '<body>Les annonces de plus de ' . $days . ' jours ont été supprimées.
				<br />
				Nombre d\'annonces supprimées: ' . $count . '</body>';
		
	}
}