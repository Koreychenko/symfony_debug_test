<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DefaultController extends AbstractController
{

    /**
     * @Route("/", name="app_homepage")
     * @return Response
     */
    public function index()
    {
        return $this->render('home.html.twig');
    }
}