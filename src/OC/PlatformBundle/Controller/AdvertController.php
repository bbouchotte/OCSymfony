<?php

namespace OC\PlatformBundle\Controller;


use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

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
		// On fixe en dur une liste ici, bien entendu par la suite
		// on la récupérera depuis la BDD !
		$listAdverts = array(
				array('id' => 2, 'title' => 'Recherche développeur Symfony'),
				array('id' => 5, 'title' => 'Mission de webmaster'),
				array('id' => 9, 'title' => 'Offre de stage webdesigner')
		);
	
		return $this->render('OCPlatformBundle:Advert:menu.html.twig', array(
				// Tout l'intérêt est ici : le contrôleur passe
				// les variables nécessaires au template !
				'listAdverts' => $listAdverts
		));
	}
    
    public function viewAction($id)
    {    
    	$advert = array(
    			'title'   => 'Recherche développpeur Symfony2',
    			'id'      => $id,
    			'author'  => 'Alexandre',
    			'content' => 'Nous recherchons un développeur Symfony2 débutant sur Lyon. Blabla…',
    			'date'    => new \Datetime()
    	);
    	
    	return $this->render('OCPlatformBundle:Advert:view.html.twig', array(
    			'advert' => $advert
    	));
    }

    public function addAction(Request $request)
    {
    	if ($request->isMethod('POST')) {
    		$session->getFlashBag()->add('notice', 'Annonce bien enregistrée.');
       		return $this->redirectToRoute('oc_platform_view', array( 'id' => 5));
    	}
    	return $this->render('OCPlatformBundle:Advert:add.html.twig');
	}
    
    public function editAction($id, Request $request)
    {
    	if ($request->isMethod('POST')) {
    		$request->getSession()->getFlashBag()->add('notice', 'Annonce bien modifiée.');
    		return $this->redirectToRoute('oc_platform_view', array( 'id' => 5));
    	}
    	$advert = array(
    			'title'   => 'Recherche développpeur Symfony',
    			'id'      => $id,
    			'author'  => 'Alexandre',
    			'content' => 'Nous recherchons un développeur Symfony débutant sur Lyon. Blabla…',
    			'date'    => new \Datetime()
    	);
    	
    	return $this->render('OCPlatformBundle:Advert:edit.html.twig', array(
    			'advert' => $advert
    	));
    }
    
    public function deleteAction($id)
    {
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