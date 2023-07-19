<?php

namespace App\Controller;

use Doctrine\ODM\MongoDB\DocumentManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;


class CinemasController extends AbstractController
{
    #[Route('/cinemas', name: 'app_cinemas')]
    public function index(DocumentManager $dm): Response

}

//new JsonResponse()