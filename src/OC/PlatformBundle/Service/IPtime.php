<?php
namespace OC\PlatformBundle\Service;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use OC\PlatformBundle\Entity\Advert;

class IPtime extends Bundle
{
	private $em;
	private $info;
	
	public function __construct(EntityManagerInterface $em)
	{
		$this->em = $em;
	}
	
	public function isFlood($ip, $floodTime, $className, $ip)
	{
		$changeDate = null;
		
		if ($className = 'OC\PlatformBundle\Entity\Advert'){
			$advert = new Advert();
			$advert = $this->em->getRepository('OCPlatformBundle:Advert')->findLastByIp($ip);
			if(null !== $advert && null !== $advert->getUpdatedAt()) {
				$changeDate = $advert->getUpdatedAt();				
			}
		} elseif ($className = 'OC\PlatformBundle\Entity\Application'){
			$advert = new Advert();
			$advert = $this->em->getRepository('OCPlatformBundle:Application')->findLastByIp($ip);
			$changeDate = $advert->getDate();
		}

		if(null !== $changeDate) {
			$changeDate = $changeDate->format('Y-m-d H:i:s');
			$delay = time() - strtotime($changeDate);
			if($delay < $floodTime){
				return true;
			}			
		}
		return false;
	}
	
	public function getMinDelay()
	{
		return $this->delay;
	}
	
	public function getInfo()
	{
		return $this->info;
	}
}


