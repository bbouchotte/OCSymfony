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
     * @Route("/memo_twig", name="memo_twig")
     */
    public function memo_twigAction() {
    	return $this->render('default/memo_twig.html.twig', array(
				'text' => 'TEXTE EN MAJUSCULE'
		));
    }
    
    /**
     * @Route("/memo_git", name="memo_git")
     */
    public function memo_gitAction() {
    	return $this->render('default/memo_git.html.twig');
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
    
    /**
     * @Route("/chap1_1", name="chap1_1")
     */
    public function part1_1Action() {
    	return $this->render('part1/part1_1.html.twig');
    }
    
    /**
     * @Route("/chap1_2", name="chap1_2")
     */
    public function part1_2Action() {
    	return $this->render('part1/part1_2.html.twig');
    }
    
    /**
     * @Route("/chap1_3", name="chap1_3")
     */
    public function part1_3Action() {
    	return $this->render('part1/part1_3.html.twig');
    }
    

    /**
     * @Route("/chap2_1", name="chap2_1")
     */
    public function part2_1Action() {
    	return $this->render('part2/part2_1.html.twig');
    }

    /**
     * @Route("/chap2_2", name="chap2_2")
     */
    public function part2_2Action() {
    	return $this->render('part2/part2_2.html.twig');
    }
    
    /**
     * @Route("/chap2_3", name="chap2_3")
     */
    public function part2_3Action() {
    	return $this->render('part2/part2_3.html.twig');
    }
    
    /**
     * @Route("/chap2_4", name="chap2_4")
     */
    public function part2_4Action() {
    	return $this->render('part2/part2_4.html.twig');
    }

    /**
     * @Route("/chap2_5", name="chap2_5")
     */
    public function part2_5Action() {
    	return $this->render('part2/part2_5.html.twig');
    }


}
