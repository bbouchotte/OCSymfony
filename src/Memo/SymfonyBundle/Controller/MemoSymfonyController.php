<?php

namespace Memo\SymfonyBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class MemoSymfonyController extends Controller
{
    /**
     * @Route("/memo_symfony", name="memo_symfony")
     */
    public function indexAction()
    {
        return $this->render('MemoSymfonyBundle:Default:index.html.twig');
    }

    /**
     * @Route("/nav", name="nav")
     */
    public function navAction() {
    	return $this->render('MemoSymfonyBundle:Default:nav.html.twig');
    }
    
    /**
     * @Route("/memo_twig", name="memo_twig")
     */
    public function memo_twigAction() {
    	return $this->render('MemoSymfonyBundle:Default:memo_twig.html.twig', array(
    			'text' => 'TEXTE EN MAJUSCULE'
    	));
    }
    
    /**
     * @Route("/memo_git", name="memo_git")
     */
    public function memo_gitAction() {
    	return $this->render('MemoSymfonyBundle:Default:memo_git.html.twig');
    }

    /**
     * @Route("/memo_mysql", name="memo_mysql")
     */
    public function memo_mysqlAction() {
    	return $this->render('MemoSymfonyBundle:Default:memo_mysql.html.twig');
    }
    
    /**
     * @Route("/part1", name="part1")
     */
    public function part1Action() {
    	return $this->render('MemoSymfonyBundle:part1:index.html.twig');
    }
    
    /**
     * @Route("/part2", name="part2")
     */
    public function part2Action() {
    	return $this->render('MemoSymfonyBundle:part2:index.html.twig');
    }

    /**
     * @Route("/part3", name="part3")
     */
    public function part3Action() {
    	return $this->render('MemoSymfonyBundle:part3:index.html.twig');
    }

    /**
     * @Route("/part4", name="part4")
     */
    public function part4Action() {
    	return $this->render('MemoSymfonyBundle:part4:index.html.twig');
    }
    
    /**
     * @Route("/chap1_1", name="chap1_1")
     */
    public function part1_1Action() {
    	return $this->render('MemoSymfonyBundle:part1:part1_1.html.twig');
    }
    
    /**
     * @Route("/chap1_2", name="chap1_2")
     */
    public function part1_2Action() {
    	return $this->render('MemoSymfonyBundle:part1:part1_2.html.twig');
    }
    
    /**
     * @Route("/chap1_3", name="chap1_3")
     */
    public function part1_3Action() {
    	return $this->render('MemoSymfonyBundle:part1:part1_3.html.twig');
    }
    
    
    /**
     * @Route("/chap2_1", name="chap2_1")
     */
    public function part2_1Action() {
    	return $this->render('MemoSymfonyBundle:part2:part2_1.html.twig');
    }
    
    /**
     * @Route("/chap2_2", name="chap2_2")
     */
    public function part2_2Action() {
    	return $this->render('MemoSymfonyBundle:part2:part2_2.html.twig');
    }
    
    /**
     * @Route("/chap2_3", name="chap2_3")
     */
    public function part2_3Action() {
    	return $this->render('MemoSymfonyBundle:part2:part2_3.html.twig');
    }
    
    /**
     * @Route("/chap2_4", name="chap2_4")
     */
    public function part2_4Action() {
    	return $this->render('MemoSymfonyBundle:part2:part2_4.html.twig');
    }
    
    /**
     * @Route("/chap2_5", name="chap2_5")
     */
    public function part2_5Action() {
    	return $this->render('MemoSymfonyBundle:part2:part2_5.html.twig');
    }
    
    /**
     * @Route("/chap2_6", name="chap2_6")
     */
    public function part2_6Action() {
    	return $this->render('MemoSymfonyBundle:part2:part2_6.html.twig');
    }
    
    /**
     * @Route("/DependencyInjectionExample", name="DependencyInjectionExample")
     */
    public function DependencyInjectionExampleAction() {
    	return $this->render('MemoSymfonyBundle:part2:DependencyInjectionExample.html.twig');
    }
    
    /**
     * @Route("/chap3_1", name="chap3_1")
     */
    public function part3_1Action() {
    	return $this->render('MemoSymfonyBundle:part3:part3_1.html.twig');
    }

    /**
     * @Route("/chap3_2", name="chap3_2")
     */
    public function part3_2Action() {
    	return $this->render('MemoSymfonyBundle:part3:part3_2.html.twig');
    }

    /**
     * @Route("/chap3_3", name="chap3_3")
     */
    public function part3_3Action() {
    	return $this->render('MemoSymfonyBundle:part3:part3_3.html.twig');
    }

    /**
     * @Route("/chap3_4", name="chap3_4")
     */
    public function part3_4Action() {
    	return $this->render('MemoSymfonyBundle:part3:part3_4.html.twig');
    }

    /**
     * @Route("/chap3_5", name="chap3_5")
     */
    public function part3_5Action() {
    	return $this->render('MemoSymfonyBundle:part3:part3_5.html.twig');
    }

    /**
     * @Route("/chap3_6", name="chap3_6")
     */
    public function part3_6Action() {
    	return $this->render('MemoSymfonyBundle:part3:part3_6.html.twig');
    }
    
    /**
     * @Route("/chap4_1", name="chap4_1")
     */
    public function part4_1Action() {
    	return $this->render('MemoSymfonyBundle:part4:part4_1.html.twig');
    }
    
    /**
     * @Route("/chap4_2", name="chap4_2")
     */
    public function part4_2Action() {
    	return $this->render('MemoSymfonyBundle:part4:part4_2.html.twig');
    }
    
    /**
     * @Route("/chap4_3", name="chap4_3")
     */
    public function part4_3Action() {
    	return $this->render('MemoSymfonyBundle:part4:part4_3.html.twig');
    }
    
    /**
     * @Route("/chap4_4", name="chap4_4")
     */
    public function part4_4Action() {
    	return $this->render('MemoSymfonyBundle:part4:part4_4.html.twig');
    }
    
    /**
     * @Route("/chap4_5", name="chap4_5")
     */
    public function part4_5Action() {
    	return $this->render('MemoSymfonyBundle:part4:part4_5.html.twig');
    }
    
    /**
     * @Route("/chap4_6", name="chap4_6")
     */
    public function part4_6Action() {
    	return $this->render('MemoSymfonyBundle:part4:part4_16html.twig');
    }
    
}
    
