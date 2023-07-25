<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/board')]
class BoardController extends AbstractController
{
    #[Route('/', name: 'app_board')]
    public function index(): Response
    {
        // Affiche la page d'accueil du tableau de bord
        return $this->render('board/index.html.twig', [
            'controller_name' => 'BoardController',
        ]);
    }

    #[Route('/home', name: 'app_board_home')]
    public function home(): Response
    {
        // Affiche la page d'accueil personnalisée du tableau de bord
        return $this->render('board/home.html.twig', [
        ]);
    }

    #[Route('/cinema', name: 'app_board_cinema')]
    public function cinema(): Response
    {
        // Affiche la page des cinémas dans le tableau de bord
        return $this->render('board/cinema.html.twig', [
        ]);
    }

    #[Route('/film', name: 'app_board_film')]
    public function film(): Response
    {
        // Affiche la page des films dans le tableau de bord
        return $this->render('board/film.html.twig', [
        ]);
    }

    #[Route('/reservation', name: 'app_board_reservation')]
    public function reservation(): Response
    {
        // Affiche la page des réservations dans le tableau de bord
        return $this->render('board/reservation.html.twig', [
        ]);
    }

    #[Route('/fidelite', name: 'app_board_fidelite')]
    public function fidelite(): Response
    {
        // Affiche la page du programme de fidélité dans le tableau de bord
        return $this->render('board/fidelite.html.twig', [
        ]);
    }

}
