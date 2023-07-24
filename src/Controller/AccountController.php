<?php

namespace App\Controller;

use App\Document\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Doctrine\ODM\MongoDB\DocumentManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;


#[Route('/mon-compte')]
class AccountController extends AbstractController
{
    #[Route('/', name: 'app_my_account_show')]
    public function index(SessionInterface $session): Response
    {
     
        // mémorise l'id du user en session
        $session->set('id', $this->getUser()->getId());

        return $this->render('account/index.html.twig', [
            'controller_name' => 'ProfilController',
            'firsttime' => $this->getUser()->isFirstConnection()
        ]);
    }

    #[Route('/edit', name: 'app_my_account_edit')]
    public function edit( Request $request, UserRepository $userRepository, DocumentManager $dm): Response
    {
      
        
        $user = $this->getUser();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $userRepository->save($user, true);
            return $this->redirectToRoute('app_login', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('account/edit.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }
}
