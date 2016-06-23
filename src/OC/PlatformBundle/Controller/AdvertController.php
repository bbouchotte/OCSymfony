<?php

namespace OC\PlatformBundle\Controller;


use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AdvertController extends Controller

{
	public function indexAction($page) {
		return new Response("Acceuil avec la page n°".$page);
	}
    
    public function viewAction($id)
    {    
    	return new Response("Affichage de l'annonce d'id : ".$id);
    }

    public function addAction()
    {
    	return new Response("Ajout de l'annonce ");
    }
    
    public function editAction($id)
    {
    	return new Response("Edition de l'annonce d'id : ".$id);
    }
    
    public function deleteAction($id)
    {
    	return new Response("Supression de l'annonce d'id : ".$id);
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

}