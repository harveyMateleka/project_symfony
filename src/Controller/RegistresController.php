<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RegistresController extends AbstractController
{
    #[Route('/registres', name: 'app_registres')]
    public function index(): Response
    {
        return $this->render('registres/index.html.twig');
    }
}
