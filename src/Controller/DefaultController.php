<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\BrowserKit\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/default")
 */
class DefaultController extends AbstractController
{
    
     /**
     * @Route("/", name="home_page")
     */
    public function index(): Response
    {
        return $this->render('default/accueil.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }

    
     /**
     * @Route("/admin", name="admin_page")
     */
    public function indexAdmin(): Response
    {
        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }

}
