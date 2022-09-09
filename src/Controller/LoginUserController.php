<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LoginUserController extends AbstractController
{
    #[Route('/login_user', name: 'app_login_user')]
    public function index(): Response
    {
        return $this->render('login_user/index.html.twig');
    }
}
