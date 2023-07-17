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


#[Route('/mon-compte')]
class AccountController extends AbstractController
{
    #[Route('/', name: 'app_my_account_show')]
    public function show(UserRepository $userRepository, SessionInterface $session): Response
    {
        $email = $session->get('email');
        $user = $userRepository->findOneBy(['email' => $email]);

    
        return $this->render('account/show.html.twig', [
            'user' => $user
        ]);
    }

    #[Route('/edit', name: 'app_my_account_edit')]
    public function edit( Request $request, UserRepository $userRepository, DocumentManager $dm): Response
    {
        // Recuperer le 1er utilisateur de la bdd
        $user = $userRepository->findOneBy([]);
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $userRepository->save($user, true);
            return $this->redirectToRoute('app_my_account_show', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('account/edit.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }
}
