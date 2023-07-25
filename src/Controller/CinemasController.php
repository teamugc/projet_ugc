<?php

namespace App\Controller;

use App\Document\Cinemas;
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
    public function index(Request $request, string $search): Response
    {
        // Récupère le terme de recherche de l'URL
        $search = trim(strtolower($request->get('search')));

        // Prépare le tableau pour stocker les données des cinémas pour la réponse JSON
        $response = [];

        // Récupère les cinémas à partir du repository en fonction du terme de recherche
        // et d'une limite de 3 résultats
        $cinemas = $this->cinemasRepository->findByCriterias($search, 3);

        // Formatte les données des cinémas pour la réponse JSON
        foreach ($cinemas as $cinema) {
            $response[] = [
                'id'        => $cinema->getId(),
                'name'      => $cinema->getName(),
                'address'   => $cinema->getAddress(),
                'zipcode'   => $cinema->getZipcode(),
                'city'      => $cinema->getCity(),
                'image'     => $cinema->getImage(),
            ];
        }

        // Renvoie une réponse JSON avec les données des cinémas
        return new JsonResponse($response);
    }
}
