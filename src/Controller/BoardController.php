<?php

namespace App\Controller;

use App\Document\Movie;
use App\Document\User;
use App\Repository\MovieRepository;
use Doctrine\ODM\MongoDB\DocumentManager;
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
    public function filmsByPreferredGenres(MovieRepository $movieRepository): Response
    {
        // Récupérer l'utilisateur actuellement authentifié
        $user = $this->getUser();

        // Vérifier que l'utilisateur a des préférences
        // if ($user && !empty($user->getGenres())) {
        $preferredGenres = $user->getGenres();
        
        

        // Rechercher les films correspondant aux genres préférés de l'utilisateur
        $recommendedMovies = $movieRepository->findByGenres($preferredGenres);

        // Initialiser $imgStar en tant que tableau vide
        $imgStar = [];

        // Accéder à la note de chaque film dans le tableau $recommendedMovies
        foreach ($recommendedMovies as $movie) {
            // On va chercher la note du film dans la base de
            $stars = $movie->getTmdbVoteAvg();
            // Utiliser la fonction calculateStars pour obtenir le tableau d'images d'étoiles
            $starsImages  = $movieRepository->calculateStars($stars);
            // assigner $imgStar à chaque movie en fonction de son id
            $imgStar[$movie->getId()] = $starsImages;
        }   
        
        return $this->render('board/film.html.twig', [
            'recommendedMovies' => $recommendedMovies,
            'imgStar' => $imgStar
        ]);
        //} else {
            // Si l'utilisateur n'a pas de préférences de genre,lui proposer des films populaires.
            // return $this->render('film/no_preferences.html.twig');
        }
    }
 //}
