<?php

namespace App\Controller;

use App\Document\Users;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ODM\MongoDB\DocumentManager;
use App\Document\Users\preferencies;


class UserController extends AbstractController
{
 
    #[Route('/', name: 'app_home')]
    public function showAction(DocumentManager $dm)
    {
        $product = $dm->getRepository(Users::class)->findAll();

        // var_dump($product);
        dump($product);
    }


}