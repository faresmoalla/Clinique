<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ResponseController extends AbstractController
{
    #[Route('/response', name: 'app_response')]
    public function index(): Response
    {
        return $this->render('response/index.html.twig', [
            'controller_name' => 'ResponseController',
        ]);
    }
}
