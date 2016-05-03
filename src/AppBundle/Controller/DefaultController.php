<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
   /*     return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..'),
        ]);
        */
        return $this->render('default/index.html.twig');
    }
    
    /**
     * @Route("/nav", name="nav")
     */
    public function navAction() {
    	return $this->render('default/nav.html.twig');
    }
    
    /**
     * @Route("/part1", name="part1")
     */
    public function part1Action() {
    	return $this->render('part1/index.html.twig');
    }    
    /**
     * @Route("/part2", name="part2")
     */
    public function part2Action() {
    	return $this->render('part2/index.html.twig');
    }
}
