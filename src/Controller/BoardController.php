<?php

namespace App\Controller;

use App\Document\Movie;
use App\Document\User;
use App\Repository\CinemasRepository;
use App\Repository\MovieRepository;
use App\Repository\UserRepository;
use Doctrine\ODM\MongoDB\DocumentManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;


#[Route('/board')]
class BoardController extends AbstractController
{
    #[Route('/', name: 'app_board')]
    public function index(SessionInterface $session,
                         UserRepository $userRepository,
                         CinemasRepository $cinemasRepository): Response
    {
        $userId = $session->get('id');
        $user = $userRepository->findUserById($userId);
        $firstname = null;
        $firstname = $user->getFirstName();

        return $this->render('board/index.html.twig', [
            'controller_name' => 'BoardController',
            'firstname' => $firstname,
            
        ]);
    }

    #[Route('/home', name: 'app_board_home')]
    public function home(SessionInterface $session, 
                        UserRepository $userRepository,
                        CinemasRepository $cinemasRepository): Response
    {
        $name = null;
        $firstname = null;

        $userId = $session->get('id');
        $user = $userRepository->findUserById($userId);
        $firstname = $user->getFirstName();

        // $cinemaName = $session->get('name');
        // $cinema = $cinemasRepository->findCinemaByName($cinemaName);
        // if ($cinema) {
        //     $name = $cinema->getname();
        // }

        return $this->render('board/home.html.twig', [
            'firstname' => $firstname,
            'name' => $name,
        ]);
    }

    #[Route('/cinema', name: 'app_board_cinema')]
    public function cinema(SessionInterface $session, UserRepository $userRepository): Response
    {
        $userId = $session->get('id');
        $user = $userRepository->findUserById($userId);
        $firstname = null;
        $firstname = $user->getFirstName();

        return $this->render('board/cinema.html.twig', [
            'firstname' => $firstname,
        ]);
    }

    #[Route('/reservation', name: 'app_board_reservation')]
    public function reservation(SessionInterface $session, UserRepository $userRepository): Response
    {
        $userId = $session->get('id');
        $user = $userRepository->findUserById($userId);
        $firstname = null;
        $firstname = $user->getFirstName();

        return $this->render('board/reservation.html.twig', [
            'firstname' => $firstname,
        ]);
    }

    #[Route('/fidelite', name: 'app_board_fidelite')]
    public function fidelite(SessionInterface $session, UserRepository $userRepository): Response
    {
        $userId = $session->get('id');
        $user = $userRepository->findUserById($userId);
        $firstname = null;
        $firstname = $user->getFirstName();

        return $this->render('board/fidelite.html.twig', [
            'firstname' => $firstname,
        ]);
    }
    #[Route('/film', name: 'app_board_film')]
    public function filmsByPreferredGenres( SessionInterface $session, UserRepository $userRepository, MovieRepository $movieRepository): Response
    {
        // Récupérer l'utilisateur actuellement authentifié
        $user = $this->getUser();
        $userId = $session->get('id');
        $user = $userRepository->findUserById($userId);
        $firstname = null;
        $firstname = $user->getFirstName();

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
            'imgStar' => $imgStar,
            'firstname' => $firstname,
        ]);
        //} else {
            // Si l'utilisateur n'a pas de préférences de genre,lui proposer des films populaires.
            // return $this->render('film/no_preferences.html.twig');
        }
    }
 //}
