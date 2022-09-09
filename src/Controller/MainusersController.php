<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainusersController extends AbstractController
{
    #[Route('/mainusers', name: 'app_mainusers')]
    public function index(): Response
    {
        return $this->render('mainusers/index.html.twig', [
            'controller_name' => 'MainusersController',
        ]);
    }
}
