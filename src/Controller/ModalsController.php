<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ModalsController extends AbstractController
{
    #[Route('/modals_accueil', name: 'app_modals_accueil')]
    public function accueil(): Response
    {
        return $this->render('modals/modals_accueil.html.twig', [
            'controller_name' => 'ModalsController',
        ]);
    }

    #[Route('/modals_new_connexion', name: 'app_modals_new_connexion')]
    public function new_connexion(): Response
    {
        return $this->render('modals/modals_new_connexion.html.twig', [
            'controller_name' => 'ModalsController',
        ]);
    }

    #[Route('/modals_choose_cinema', name: 'app_modals_choose_cinema')]
    public function choose_cinema(): Response
    {
        return $this->render('modals/modals_choose_cinema.html.twig', [
            'controller_name' => 'ModalsController',
        ]);
    }

    #[Route('/modals_choose_seats', name: 'app_modals_choose_seats')]
    public function choose_seats(): Response
    {
        return $this->render('modals/modals_choose_seats.html.twig', [
            'controller_name' => 'ModalsController',
        ]);
    }

    #[Route('/modals_choose_categories', name: 'app_modals_choose_categories')]
    public function choose_categories(): Response
    {
        return $this->render('modals/modals_choose_categories.html.twig', [
            'controller_name' => 'ModalsController',
        ]);
    }

    #[Route('/modals_choose_actors', name: 'app_modals_choose_actors')]
    public function choose_actors(): Response
    {
        return $this->render('modals/modals_choose_actors.html.twig', [
            'controller_name' => 'ModalsController',
        ]);
    }

    #[Route('/modals_fidelity', name: 'app_modals_fidelity')]
    public function choose_fidelity(): Response
    {
        return $this->render('modals/modals_choose_fidelity.html.twig', [
            'controller_name' => 'ModalsController',
        ]);
    }
}
