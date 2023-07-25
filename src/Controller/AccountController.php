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
    #[Route('/', name: 'app_my_account_index')]
    public function index(): Response
    {
        // Affiche la page de profil de l'utilisateur actuellement connecté
        return $this->render('account/index.html.twig', [
            'controller_name' => 'ProfilController',
            'user' => $this->getUser(),
        ]);
    }

    #[Route('/', name: 'app_my_account_show')]
    public function show(UserRepository $userRepository, SessionInterface $session): Response
    {
        // Récupère l'utilisateur actuellement connecté
        $user = $this->getUser();

        // Vérifie si l'utilisateur est connecté, sinon redirige vers la page de connexion
        if (is_null($user)) {
            return $this->redirectToRoute('app_login', [], Response::HTTP_SEE_OTHER);
        }

        // Affiche la page de détails du profil de l'utilisateur
        return $this->render('account/show.html.twig', [
            'user' => $user
        ]);
    }

    #[Route('/edit', name: 'app_my_account_edit')]
    public function edit(Request $request, UserRepository $userRepository, DocumentManager $dm): Response
    {
        // Récupère l'utilisateur actuellement connecté
        $user = $this->getUser();

        // Crée le formulaire d'édition du profil de l'utilisateur
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        // Si le formulaire est soumis et valide, enregistre les modifications dans la base de données
        if ($form->isSubmitted() && $form->isValid()) {
            $userRepository->save($user, true);
            return $this->redirectToRoute('app_login', [], Response::HTTP_SEE_OTHER);
        }

        // Affiche la page d'édition du profil de l'utilisateur
        return $this->renderForm('account/edit.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }
}
