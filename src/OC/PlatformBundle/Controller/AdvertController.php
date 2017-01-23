<?php

namespace OC\PlatformBundle\Controller;


use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\PreconditionFailedHttpException;

use OC\PlatformBundle\Entity\Advert;
use OC\PlatformBundle\Entity\Image;
use OC\PlatformBundle\Entity\Application;
use OC\PlatformBundle\Entity\Category;
use OC\PlatformBundle\Entity\Skill;
use OC\PlatformBundle\Entity\Advert_Skill;

use Gedmo\Exception;
use OC\PlatformBundle\Form\AdvertType;
use OC\PlatformBundle\Form\AdvertEditType;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class AdvertController extends Controller

{	
	private function getRepo($entity) {
		return $this->getDoctrine()->getRepository('OCPlatformBundle:' . $entity);
	}
	
	public function indexAction($page) {
		$nbPerPage = 3;
		$repository = $this->getRepo('Advert');
// 		$adverts = $repository->findAll();
		$adverts = $repository->getAdverts($page, $nbPerPage);
		
		if ($page < 1) {
			throw new NotFoundHttpException('Page "'.$page.'" inexistante.');
		}
		
		$nbPages = ceil(count($adverts) / $nbPerPage);
		if ($page > $nbPages) {
			throw $this->createNotFoundException("La page ".$page." n'existe pas.");
		}
		
		return $this->render('OCPlatformBundle:Advert:index.html.twig', array(
  			'listAdverts' => $adverts,
			'nbPages' => $nbPages,
			'page' => $page,
		));
	}
	
	public function menuAction($limit)
	{		
		$listAdverts = [];
		$repository = $this->getRepo('Advert');
// 		$listAdverts = $repository->findAllLimit($limit);
		//ou
		$listAdverts = $repository->findBy(
			array(),
			array('date' => 'desc'),
			$limit,
			0
		);
		if ($listAdverts === null) {
			throw new NotFoundHttpException('Impossible de trouver les ' . $limit . ' dernières annonces.');
		}
		return $this->render('OCPlatformBundle:Advert:menu.html.twig', array(
				'listAdverts' => $listAdverts
		));
	}
    
    public function viewAction($id)
    {
//    	$repository = $this->getRepo('Advert');
//     	$advert = $repository->find($id);
		$advert = $this->getRepo('Advert')->getCompleteAdvert($id);
//		$advert = $repository->myFindDQL($id);
    	
    	if (null === $advert) {
    		throw new NotFoundHttpException("L'annonce d'id ".$id." n'existe pas.");
    	}
    	/*
    	$applications = $this->getRepo('Application')
    		->findBy(array('advert' => $advert));*/
    	
    	$advertSkills = $this->getRepo('Advert_Skill')
	  		->findBy(array('advert' => $advert));
    	
//    	$advertCategories = $this->getRepo('Category')
//    		->findBy(array('adverts' => array($advert)));
    		
    	return $this->render('OCPlatformBundle:Advert:view.html.twig', array(
    			'advert' => $advert,
    			//'applications' => $applications,
    			'advertSkills' =>$advertSkills
    	));
    }

    public function addAction(Request $request)
    {
    	$advert = new Advert();
    	$advert->setAuthor('Benjamin'); // Va afficher cette valeur par défaut dans le formulaire
    	$advert->setIp($request->getClientIp());

    	$form = $this->createForm(AdvertType::class, $advert);
		// ou
		//$form = $this->get('form.factory')->create(AdvertType::class, $advert);
    	
		if($request->isMethod('POST') && $form->handleRequest($request)->isValid())
		{
			$em = $this->getDoctrine()->getManager();
			$em->persist($advert);
			$em->flush();
			
			$request->getSession()->getFlashBag()->add('notice', 'Annonce enregistrée.');
			
			return $this->redirectToRoute('oc_platform_view',
				array('id' => $advert->getId())
			);
		}
    	
    	return $this->render('OCPlatformBundle:Advert:add.html.twig', array(
    			'form' => $form->createView(),
    	));
	}
    
    public function editAction($id, Request $request)
    {
    	$advert = new Advert();
    	
    	$ip = $request->getClientIp();
    	//$advert = $this->getRepo('Advert')->find($id);
    	$advert = $this->getRepo('Advert')->getCompleteAdvert($id);
    	if ($advert === null) {
    		throw new NotFoundHttpException("L'annonce d'id ".$id." n'existe pas.");
    	}
    	
    	$form = $this->createForm(AdvertEditType::class, $advert);
    	
    	if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
    		$advert->setIp($ip);
    		$advert->setUpdatedAt(new \Datetime());
    		$em = $this->getDoctrine()->getManager();
    		$em->persist($advert);
    		$em->flush();    			
	    	$request->getSession()->getFlashBag()->add('notice', 'Annonce bien modifiée.');
	   		return $this->redirectToRoute('oc_platform_view', array( 'id' => $id, 'ip' => $ip));
    	}

    	return $this->render('OCPlatformBundle:Advert:edit.html.twig', array(
    			'advert' 	=> $advert,
    			'form'		=> $form->createView()
    	));
    }
    
    public function deleteAction(Request $request, $id)
    {
    	$em = $this->getDoctrine()->getManager();
    	$advert = $this->getRepo('Advert')->find($id);
    	 
    	if ($advert === null) {
    		throw new NotFoundHttpException("L'annonce d'id ".$id." n'existe pas.");
    	}
    	
    	$form = $this->get('form.factory')->create();	// On crée un formulaire vide
    	if($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
    		$em->remove($advert);
    		$em->flush();
    		$request->getSession()->getFlashBag()->add('info', 'L\'annonce a bien été supprimée.');
    		return $this->redirectToRoute('oc_platform_home');
    	}
    	
    	return $this->render('OCPlatformBundle:Advert:delete.html.twig', array(
    		'advert' => $advert,
			'form' => $form->createView()
    	));
    }
    
    public function purgeAction($days)
    {
    	$purger = $this->get('oc_platform.purger.advert');
    	$text = $purger->purge($days);
    	return new Response($text);
    }
    
    public function deleteApplicationAction($idAdvert, $idApplication)
    {
    	$em = $this->getDoctrine()->getManager();
    	$application = $em->getRepository('OCPlatformBundle:Application')->find($idApplication);
    	$em->remove($application);
    	$em->flush();
    	 
    	return $this->redirectToRoute('oc_platform_view', array('id' => $idAdvert));
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
    
    public function getAdvertWithCategoriesAction() {
    	$repository = $this->getDoctrine()->getRepository('OCPlatformBundle:Advert');
    	$listAdverts = $repository->getAdvertWithCategories(array('Développeur', 'Intégrateur'));
    	
    	return $this->render('OCPlatformBundle:Advert:index.html.twig', array(
    			'listAdverts' => $listAdverts
    	));
    }
    
    public function getApplicationsWithAdvertAction($limit){
    	$repository = $this->getDoctrine()->getRepository('OCPlatformBundle:Application');
    	$applications = $repository->getApplicationsWithAdvert($limit);
    	return $this->render('OCPlatformBundle:Advert:gawa.html.twig', array(
    			'applications' => $applications
    	));
    }

}