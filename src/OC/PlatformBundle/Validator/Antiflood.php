<?php
namespace OC\PlatformBundle\Validator;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class Antiflood extends Constraint
{
	public $message;
	public $floodTime;
	
	public function __construct()
	{
	//	$this->message = "Vous avez déjà posté un message il y a moins de " . $this->floodTime . " secondes, merci d'attendre un peu.";
	}
	
	public function validatedBy()
	{
		return 'oc_platform_antiflood';
	}
	
	public function getMessage()
	{
		return "Vous avez déjà posté un message il y a moins de " . $this->floodTime . " secondes, merci d'attendre un peu.";
	}
}