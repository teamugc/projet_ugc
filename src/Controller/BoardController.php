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
        return $this->render('board/index.html.twig', [
            'controller_name' => 'BoardController',
        ]);
    }

    #[Route('/home', name: 'app_board_home')]
    public function home(): Response
    {
        return $this->render('board/home.html.twig', [
        ]);
    }

    #[Route('/cinema', name: 'app_board_cinema')]
    public function cinema(): Response
    {
        return $this->render('board/cinema.html.twig', [
        ]);
    }

    #[Route('/film', name: 'app_board_film')]
    public function film(): Response
    {
        return $this->render('board/film.html.twig', [
        ]);
    }

    #[Route('/reservation', name: 'app_board_reservation')]
    public function reservation(): Response
    {
        return $this->render('board/reservation.html.twig', [
        ]);
    }

    #[Route('/fidelite', name: 'app_board_fidelite')]
    public function fidelite(): Response
    {
        return $this->render('board/fidelite.html.twig', [
        ]);
    }

}
