<?php
namespace OC\PlatformBundle\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use OC\PlatformBundle\Service\IPtime;

class AntifloodValidator extends ConstraintValidator
{
	private $requestStack;
	private $em;
	public $floodTime;
	private $ipTime;
	
	// Les arguments déclarés dans la définition du service arrivent au constructeur
	// On doit les enregistrer dans l'objet pour pouvoir s'en resservir dans la méthode validate()
	public function __construct(RequestStack $requestStack, EntityManagerInterface $em, $floodTime, IPtime $ipTime)
	{
		$this->requestStack = $requestStack;
		$this->em           = $em;
		$this->floodTime = $floodTime;
		$this->ipTime = $ipTime;
	}
	
	public function validate($value, Constraint $constraint)
	{
		// Pour récupérer l'objet Request tel qu'on le connait, il faut utiliser getCurrentRequest du service request_stack
		$request = $this->requestStack->getCurrentRequest();
		
	
		// On récupère l'IP de celui qui poste
		$ip = $request->getClientIp();
		$className = $this->context->getClassName();
	
/*		// On vérifie si cette IP a déjà posté une candidature il y a moins de 15 secondes
		$isFlood = $this->em
		->getRepository('OCPlatformBundle:Application')
		->isFlood($ip, 15) // Bien entendu, il faudrait écrire cette méthode isFlood, c'est pour l'exemple
		;
*/		
		
		$isFlood = $this->ipTime->isFlood($ip, $this->floodTime, $className, $ip);
	
		if ($isFlood) {
			$constraint->floodTime = $this->floodTime;
			// C'est cette ligne qui déclenche l'erreur pour le formulaire, avec en argument le message
			
			$this->context->addViolation($constraint->getMessage());
		}
	}
}