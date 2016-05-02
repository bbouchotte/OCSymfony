<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class Part1_1Controller extends Controller
{
    
    /**
     * @Route("/chap1_1", name="chap1_1")
     */
    public function part1_1Action() {
    	return $this->render('part1/part1_1.html.twig');
    }
}
