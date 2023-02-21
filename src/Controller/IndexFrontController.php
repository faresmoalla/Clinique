<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexFrontController extends AbstractController
{
    /**
     * @Route("/front", name="app_index_front")
     */
    public function index(): Response
    {
        return $this->render('index_front/index.html.twig', [
            'controller_name' => 'IndexFrontController',
        ]);
    }
}
