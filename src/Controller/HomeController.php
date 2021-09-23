<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{

    /**
     * @Route("/", name="home")
     */
    public function afficherHome(): Response
    {
        return $this->render('home.html.twig');
    }

    /**
     * @Route("/reglement", name="regle")
     */
    public function afficheRegle(): Response
    {
        return $this->render('regle.html.twig');
    }
}
