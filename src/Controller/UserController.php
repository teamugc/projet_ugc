<?php

namespace App\Controller;

use App\Document\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Doctrine\ODM\MongoDB\DocumentManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;


#[Route('/user')]
class UserController extends AbstractController
{

    #[Route('/connect/{email}', name: 'app_user_connect')]
    public function connect(string $email, SessionInterface $session){
        
        $session->set('email', $email);

        return $this->render('login/success.html.twig', [
            'message' => "Utilisateur $email connecté.",
            
        ]);
    }

    #[Route('/', name: 'app_user_index')]
    public function index(UserRepository $userRepository): Response
    {
 
        $users = $userRepository->findAll();
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
            'users' => $users
        ]);
    }


    #[Route('/new', name: 'app_user_new')]
    public function createNew( Request $request, UserRepository $userRepository, DocumentManager $dm): Response
    {
        
        
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        // etape 1
        // if ($form->isSubmitted() ) {
        //     $step=$request->request->get("step");
        //     $step++;
        // } else {
        //     $step = 1;
        // }
        if ($form->isSubmitted() && $form->isValid()) {
           
            $userRepository->save($user, true);
            return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
        }
    
        return $this->renderForm('user/new.html.twig', [
            'users' => $user,
            'form' => $form,
            // 'step' => $step,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_user_edit')]
    public function edit(string $id, Request $request, UserRepository $userRepository, DocumentManager $dm): Response
    {
        
        $user = $userRepository->find($id);
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $userRepository->save($user, true);
            return $this->redirectToRoute('app_user_show', ['id'=> $user->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('user/edit.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }
    #[Route('/{id}', name: 'app_user_show')]
    public function show(string $id, UserRepository $userRepository): Response
    {
 
        $user = $userRepository->find($id);
        return $this->render('user/show.html.twig', [
            'user' => $user
        ]);
    }
}


