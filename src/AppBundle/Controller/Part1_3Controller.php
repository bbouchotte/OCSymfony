<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class Part1_3Controller extends Controller
{
    
    /**
     * @Route("/chap1_3", name="chap1_3")
     */
    public function part1_3Action() {
    	return $this->render('part1/part1_3.html.twig');
    }
}
