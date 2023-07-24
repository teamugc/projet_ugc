<?php

namespace App\Controller;

use App\Document\Movie;
use App\Document\User;
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
    
    #[Route('/film', name: 'app_board_film')]
    public function filmsByPreferredGenres(): Response
    {
        // Récupérer l'ID de l'utilisateur depuis la session
        $userId = $this->getUser()->getId();

        // Récupérer les préférences de l'utilisateur depuis la collection "user"
        $user = $this->get('doctrine_mongodb')
        ->getRepository(User::class)
        ->find($userId);
        
        dd($user);
        // Vérifier que l'utilisateur a des préférences
        if ($user && !empty($user->getPreferences()['genres'])) {
            $preferredGenres = $user->getPreferences()['genres'];

            // Rechercher les films correspondant aux genres préférés de l'utilisateur
            $moviesRepository = $this->get('doctrine_mongodb')
                                     ->getRepository(Movie::class);
            
            $recommendedMovies = $moviesRepository->findByGenres($preferredGenres);
            return $this->render('board/film.html.twig', [
                'recommendedMovies' => $recommendedMovies,
            ]);
        } else {
            // Si l'utilisateur n'a pas de préférences de genre,lui proposer des films populaires.
            return $this->render('film/no_preferences.html.twig');
        }
    }

    #[Route('/film', name: 'app_board_film')]
    public function film(): Response
    {
        return $this->render('board/film.html.twig', [
        ]);
    }
}
