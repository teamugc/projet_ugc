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
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

#[Route('/user')]
class UserController extends AbstractController
{
    #[Route('/connect/{email}', name: 'app_user_connect')]
    public function connect(string $email, SessionInterface $session){
        
        // Action pour connecter un utilisateur en utilisant son adresse email
        $session->set('email', $email);
        $session->set('email', $email);

        return $this->render('login/index.html.twig', [
            'message' => "Utilisateur $email connecté.",
        ]);
    }

    #[Route('/list', name: 'app_user_list')]
    public function index(UserRepository $userRepository): Response
    {
 
        // Affiche la liste de tous les utilisateurs sous forme de modal (fenêtre contextuelle)
        $users = $userRepository->findAll();
        return $this->render('user/usersList.html.twig', [
            'controller_name' => 'UserController',
            'users' => $users
        ]);
    }

    #[Route('/modalStart', name: 'app_user_index')]
    public function modalStart(UserRepository $userRepository): Response
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
        // Action pour créer un nouvel utilisateur
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
           
            // Enregistre le nouvel utilisateur dans la base de données à l'aide de UserRepository
            $userRepository->save($user, true);
            return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
        }
    
        return $this->renderForm('user/new.html.twig', [
            'users' => $user,
            'form' => $form,
            
        ]);
    }

    #[Route('/{id}/edit', name: 'app_user_edit')]
    public function edit(string $id, Request $request, UserRepository $userRepository, DocumentManager $dm): Response
    {
        // Action pour modifier un utilisateur existant
        $user = $userRepository->find($id);
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

       
        if ($form->isSubmitted() && $form->isValid()) {
           
            // Enregistre les modifications de l'utilisateur dans la base de données à l'aide de UserRepository
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
        // Affiche les détails d'un utilisateur spécifique
        $user = $userRepository->find($id);
        return $this->render('user/show.html.twig', [
            'user' => $user
        ]);
    }

    #[Route('/{id}/delete', name: 'app_user_delete')]
public function delete(string $id, UserRepository $userRepository): Response
{
    $user = $userRepository->find($id);

    if (!$user) {
        throw $this->createNotFoundException('Utilisateur non trouvé');
    }

    $userRepository->remove($user, true);

    return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
}
}


