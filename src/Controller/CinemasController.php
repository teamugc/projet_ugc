<?php


namespace App\Controller;

use App\Repository\CinemasRepository;
use Doctrine\ODM\MongoDB\DocumentManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;


class CinemasController extends AbstractController
{
    protected $cinemasRepository;

    public function __construct(CinemasRepository $cinemasRepository)
    {
        $this->cinemasRepository = $cinemasRepository;
    }

    #[Route('/cinemas/{search}', name: 'app_cinemas')]
    public function index(Request $request): Response
    {
        $search = $request->get('search');
        dump($search);

        // Récupérer les cinémas à partir du repository
        $cinemas = $this->cinemasRepository->findAll();

        // traiter les données pour les préparer pour la réponse JSON
        $response = [];
        $result = '';
        if (isset ($_GET['search']) && !empty($_GET['search'])) {
            $key = trim(strtolower($_GET['search']));
        foreach ($cinemas as $cinema) {
            $response[] = [
                'id' => $cinema->getId(),
                'name' => $cinema->getName(),
                'address' => $cinema->getAddress(),
                'zipcode' => $cinema->getZipcode(),
                'city' => $cinema->getCity(),
                'image' => $cinema->getImage(),
            ];
            $formattedCinema = '<li><img src="' . $cinema['image'] . '" alt="Image du cinéma">' . '<img src=" ./img/favori-full.svg">' . $cinema['name'] . ' - Adresse : ' . $cinema['address'] . ' - Code postal : ' . $cinema['zipcode'] . '- Ville : ' . $cinema['city'] . '</li>';
            if (stripos($formattedCinema, $key) !== false) {  
                $result .= $formattedCinema;
            }
            if ($result  === '') {
                $result = 'Aucun cinema trouvé';
            }
        }
         
        // Retourner la réponse JSON avec les données des cinémas
        // return new JsonResponse($response);
        }
        // return new JsonResponse($response);
        return new Response('test');
    }
}

    

