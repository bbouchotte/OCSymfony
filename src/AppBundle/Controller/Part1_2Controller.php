<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class Part1_2Controller extends Controller
{
    
    /**
     * @Route("/chap1_2", name="chap1_2")
     */
    public function part1_2Action() {
    	return $this->render('part1/part1_2.html.twig');
    }
}
