<?php 
namespace OC\PlatformBundle\ServiceTest;

class OCServiceTest {
	
	private $advertExample;
	
	public function __construct() {
		$this->advertExample = array(
    			'title'   => 'Recherche développpeur Symfony',
    			'id' => 1, 
    			'author'  => 'Alexandre',
    			'content' => 'Nous recherchons un développeur Symfony débutant sur Lyon. Blabla… Mais en fait ceci est un test d\'utilisation de service',
    			'date'    => new \Datetime()
    	);
	}
	
	public function get() {
		return $this->advertExample;
	}
	
}