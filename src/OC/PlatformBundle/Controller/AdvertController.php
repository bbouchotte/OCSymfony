<?php

namespace OC\PlatformBundle\Controller;


use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use OC\PlatformBundle\Entity\Advert;
use OC\PlatformBundle\Entity\Image;
use OC\PlatformBundle\Entity\Application;
use OC\PlatformBundle\Entity\Category;
use OC\PlatformBundle\Entity\Skill;
use OC\PlatformBundle\Entity\AdvertSkill;

class AdvertController extends Controller

{
	public function indexAction($page) {
		$listAdverts = array(
				array(
						'title'   => 'Recherche développpeur Symfony',
						'id'      => 1,
						'author'  => 'Alexandre',
						'content' => 'Nous recherchons un développeur Symfony débutant sur Lyon. Blabla…',
						'date'    => new \Datetime()),
				array(
						'title'   => 'Mission de webmaster',
						'id'      => 2,
						'author'  => 'Hugo',
						'content' => 'Nous recherchons un webmaster capable de maintenir notre site internet. Blabla…',
						'date'    => new \Datetime()),
				array(
						'title'   => 'Offre de stage webdesigner',
						'id'      => 3,
						'author'  => 'Mathieu',
						'content' => 'Nous proposons un poste pour webdesigner. Blabla…',
						'date'    => new \Datetime())
		);
		if ($page < 1) {
			throw new NotFoundHttpException('Page "'.$page.'" inexistante.');
		}
		return $this->render('OCPlatformBundle:Advert:index.html.twig', array(
  			'listAdverts' => $listAdverts
		));
	}
	
	public function menuAction($limit)
	{
		// On fixe en dur une liste ici, bien entendu par la suite, on la récupérera depuis la BDD !
	/*	$listAdverts = array(
				array('id' => 2, 'title' => 'Recherche développeur Symfony'),
				array('id' => 5, 'title' => 'Mission de webmaster'),
				array('id' => 9, 'title' => 'Offre de stage webdesigner')
		);*/
		
		$listAdverts = [];
		$em = $this->getDoctrine()->getManager();
		$listAdverts = $em->getRepository('OCPlatformBundle:Advert')->findAll();
		
	
		return $this->render('OCPlatformBundle:Advert:menu.html.twig', array(
				// Tout l'intérêt est ici : le contrôleur passe
				// les variables nécessaires au template !
				'listAdverts' => $listAdverts
		));
	}
    
    public function viewAction($id)
    {
    	/*	// Test service:
    	 $serviceTest = $this->get('oc_platform.test');
    	 $advert = $serviceTest->get();*/
    	
    	$em = $this->getDoctrine()->getManager();
    	
    	$repository = $em->getRepository('OCPlatformBundle:Advert');
    	$advert = $repository->find($id);
    	
    	if (null === $advert) {
    		throw new NotFoundHttpException("L'annonce d'id ".$id." n'existe pas.");
    	}
    	
    	$applications = $em->getRepository('OCPlatformBundle:Application')
    		->findBy(array('advert' => $advert));
    	
    	$advertSkills = $em->getRepository('OCPlatformBundle:AdvertSkill')
    		->findBy(array('advert' => $advert));
    	
    	return $this->render('OCPlatformBundle:Advert:view.html.twig', array(
    			'advert' => $advert,
    			'applications' => $applications,
    			'advertSkills' =>$advertSkills
    	));
    }

    public function addAction(Request $request)
    {
    	
    	// test service:
    	$antispam = $this->get('oc_platform.antispam');
    	$text = "vdffdgddcsdcdsc";
    	if ($antispam->isSpam($text)) {
    		throw new \Exception("Votre message a été détecté comme un spam. " .
    				"Langue: " . $antispam->locale() . ". " .
    				"Longueur minimum: " . $antispam->minLenght() 
   				);
    	}    

    	$em = $this->getDoctrine()->getManager();
    	
    	$advert = new Advert();
    	$advert->setTitle('Recherche développeur Symfony.');
    	$advert->setAuthor('Alexandre');
    	$advert->setText("Nous recherchons un développeur Symfony débutant sur Lyon. Blabla…");
    	
    	$image = new Image;
    	$image->setUrl('http://sdz-upload.s3.amazonaws.com/prod/upload/job-de-reve.jpg');
    	$image->setAlt('Job de rêve');
    	$advert->setImage($image);
    	
    	$categories = $this->getDoctrine()->getManager()->getRepository('OCPlatformBundle:Category')->findAll();
    	foreach ($categories as $category) {
    		$advert->addCategory($category);
    	}
    	
    	$application1 = new Application();
    	$application1->setAuthor('Marine');
    	$application1->setContent("J'ai toutes les qualités requises.");
    	
    	$application2 = new Application();
    	$application2->setAuthor('Pierre');
    	$application2->setContent("Je suis très motivé.");
    	
    	$application1->setAdvert($advert);
    	$application2->setAdvert($advert);
    	
    	// pas de $em->persist($image), car on a défini le cascade={"persist"}
    	// pas de cascade pour application donc:
    	$em->persist($application1);
    	$em->persist($application2);
    	
    	$skills = $em->getRepository('OCPlatformBundle:Skill')->findAll();
    	foreach ($skills as $skill) {
    		$advertSkill = new  AdvertSkill();
    		$advertSkill->setAdvert($advert);
    		$advertSkill->setSkill($skill);
    		$advertSkill->setLevel('Expert');
    		$em->persist($advertSkill);
    	}

    	$em->persist($advert);
    	$em->flush();    	
    	
    	if ($request->isMethod('POST')) {
    		$session->getFlashBag()->add('notice', 'Annonce bien enregistrée.');
       		return $this->redirectToRoute('oc_platform_view', array( 'id' => $advert->getId()));
    	}
    	return $this->render('OCPlatformBundle:Advert:add.html.twig');
	}
    
    public function editAction($id, Request $request)
    {
    	if ($request->isMethod('POST')) {
    		$request->getSession()->getFlashBag()->add('notice', 'Annonce bien modifiée.');
    		return $this->redirectToRoute('oc_platform_view', array( 'id' => 5));
    	}
    	
    	$em = $this->getDoctrine()->getManager();
    	$advert = $em->getRepository('OCPlatformBundle:Advert')->find($id);
    	
    	if ($advert === null) {
    		throw new NotFoundHttpException("L'annonce d'id ".$id." n'existe pas.");
    	}
    	
    	$categories = $em->getRepository('OCPlatformBundle:Category')->findAll();
    	
    	foreach ($categories as $category) {
    		$advert->addCategory($category);
    	}
    	
    	$em->flush(); // inutile de persister $advert
    	
    	return $this->render('OCPlatformBundle:Advert:edit.html.twig', array(
    			'advert' => $advert
    	));
    }
    
    public function deleteAction($id)
    {
    	$em = $this->getDoctrine()->getManager();
    	$advert = $em->getRepository('OCPlatformBundle:Advert')->find($id);
    	 
    	if ($advert === null) {
    		throw new NotFoundHttpException("L'annonce d'id ".$id." n'existe pas.");
    	}
    	
    	foreach ($advert->getCategories() as $category) {
    		$advert->removeCategory($category);
    	}
    	$applications = $em->getRepository('OCPlatformBundle:Application')
    		->findBy(array('advert' => $advert));    	
    	foreach ($applications as $application) {
    		$em->remove($application);
    	}
    	
    	$em->remove($advert);
    	$em->flush();
    	
    	return $this->render('OCPlatformBundle:Advert:delete.html.twig');
    }
    
    
    
    public function hello_worldAction() {
    
    	// return new Response("Notre propre Hello World !");
    	$content = $this
    	->get('templating')
    	->render('OCPlatformBundle:Advert:index.html.twig', array('nom' => 'Winzou'));
    	return new Response($content);
    }
    
    public function viewSlugAction($year, $slug, $_format) {
    	return new Response("On pourrait afficher l'annonce correspondant au
            slug '".$slug."', créée en ".$year." et au format ".$_format.".");
    }
    
    public function errorAction() {
    	$response = new Response();     // On crée la réponse sans lui donner de contenu pour le moment
    	$response->setContent("Ceci est une page d'erreur 404");	// On définit le contenu
    	$response->setStatusCode(Response::HTTP_NOT_FOUND);	// On définit le code HTTP à « Not Found » (erreur 404)
    	return $response;
    }

}