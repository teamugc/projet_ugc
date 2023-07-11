<?php

namespace App\Controller;

use App\Document\Users;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ODM\MongoDB\DocumentManager;

class HomeController extends AbstractController
{
    // #[Route('/', name: 'app_home')]
    // public function index(): RESPONSE
    // {
    //     return $this->render('home/index.html.twig', [
    //         'controller_name' => 'HomeController',
    //     ]);
    // }


    #[Route('/', name: 'app_home')]
    public function showAction(DocumentManager $dm)
    {
        $product = $dm->getRepository(Users::class)->findAll();

        var_dump($product);
    
        // if (! $product) {
        //     throw $this->createNotFoundException('No product found for id ' . $id);
        // }
    
        // do something, like pass the $product object into a template
    }

}