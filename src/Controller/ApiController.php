<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Users;
use App\Repository\UsersRepository;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\HttpFoundation\Request;

class ApiController extends AbstractController
{
    private $tab_users;
    #[Route('/api', name: 'app_api_index')]
    public function index(): Response
    {
        return $this->render('api/index.html.twig', [
            'controller_name' => 'ApiController',
        ]);
    }

    public function __construct(UsersRepository $repository){

        $this->tab_users = $repository;
    }
    #[Route('/api/login', name: 'app_api_login',methods:['POST'])]
    public function login(Request $request,UserPasswordHasherInterface $passwordHasher){
        $email = $request->request->get('email', '');
        
        $user = $this->tab_users->findByEmail($email);
        $password = $passwordHasher($user[0],$request->request->get('password', ''));
        if ($user[0]->getPassword() == $password) {
            return $this->json([
                'status'=>200,
                'name'=>$user[0]->getLastname(),
            ]);
        }

       
   

       
    }
}
