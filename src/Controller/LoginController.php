<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class LoginController extends AbstractController
{
    #[Route('/login', name: 'app_user_login')]
    public function login(Request $request, AuthenticationUtils $authenticationUtils, SessionInterface $session): Response
    {
        // Vérifie si l'utilisateur est déjà connecté, dans ce cas, redirige vers son profil
        if ($this->getUser()) {
            return $this->redirectToRoute('app_my_account_index');
        }

        // Récupère les erreurs d'authentification éventuelles
        $error = $authenticationUtils->getLastAuthenticationError();

        // Récupère le dernier nom d'utilisateur (email) saisi pour le pré-remplir dans le formulaire
        $lastUsername = $authenticationUtils->getLastUsername();

        // Affiche la page de connexion avec les données pour le formulaire
        return $this->render('login/index.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error
        ]);
    }

    #[Route('/logout', name: 'app_user_logout')]
    public function logout(): void
    {
        // Cette méthode peut être vide car elle sera interceptée par la clé "logout" de votre pare-feu de sécurité.
        // La déconnexion sera gérée automatiquement par Symfony.
        // Le code ici ne sera pas exécuté.
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}
