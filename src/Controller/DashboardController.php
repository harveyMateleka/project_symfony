<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Users;
use App\Repository\UsersRepository;
use App\Form\FormEditType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;

class DashboardController extends AbstractController
{
    private $tab_users;
    private $crud;
    #[Route('/', name: 'app_dashboard')]

    public function index(): Response
    {
        if ($this->isGranted('ROLE_USER') == true) {
            $users = $this->tab_users->findAll();
            $usersCount=count($users);
            return $this->render('dashboard/index.html.twig',compact('usersCount'));
        }
        else{
            return $this->redirectToRoute('app_login');
        }
       
    }
    public function __construct(UsersRepository $repository, EntityManagerInterface $manager){

        $this->tab_users = $repository;
        $this->crud = $manager;
    }

    #[Route('/liste_users', name:'app_liste')]
    public function liste_users(): Response
    {
        $resultat = $this->tab_users->findAll();
        return $this->render('dashboard/views_user.html.twig',compact('resultat'));
    }

    #[Route('/users/edit/{id}', name:'app_edit.users')]
    public function edit_users(Users $users, Request $request): Response
    {
        $form = $this->createForm(FormEditType::class, $users);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->crud->flush();
            return $this->liste_users();
        }
        else{
            return $this->render('dashboard/view_edit_user.html.twig',[
                'users' => $users,
                'form' => $form->createView(),
            ]);
        }
        
    }

    #[Route('/users/delete/{id}',methods:['GET','DELETE'],name:'app_delete.users')]
    public function delete_users($id)
    {
        $users=$this->tab_users->find($id);
        $this->crud->remove($users);
        $this->crud->flush();

        return $this->redirectToRoute('app_liste');

    }

}
