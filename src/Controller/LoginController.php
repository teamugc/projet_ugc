<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;



class LoginController extends AbstractController
{
    #[Route('/login', name: 'app_login')]
    public function new(): Response
    {
 
        return $this->render('login/new.html.twig', [
        
          
        ]);
    }
}
