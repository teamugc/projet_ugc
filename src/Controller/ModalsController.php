<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/modals')]
class ModalsController extends AbstractController
{

    #[Route('/new_connection', name: 'app_modals_new_connection')]
    public function new_connection(Request $request): Response
    {
        $message = '';

        // traitement du formulaire
        $forname = $request->get('form-name');
        if ($forname == 'form_new_connection') {
            $success = true;
            
        $email = $_POST['email'];    
            // faire ici tous les test et vérifications
            if(filter_var($email, FILTER_VALIDATE_EMAIL)){
                $success = true;
            } else {
                $success = false;
                $message .= 'Adresse email invalide.<br>';
            }

            if(true){
             //  $success = false;
                $message .= 'Code postal erroné.<br>';
            }            
            // faire également les enregistrement en bdd
            //$success = false;

            // si tout va bien passer à l'étape suivante
            if ($success)
                return $this->accueil($request);
        }

        // affichage du formulaire
        return $this->render('modals/modal_new_connection.html.twig', [
            'message' => $message,
            'formName' => 'form_new_connection',
            'step' => '/modals/new_connection',
            'previousStep' => '',
        ]);
    }

    #[Route('/accueil', name: 'app_modals_accueil')]
    public function accueil(Request $request): Response
    {
        $message = '';

        // traitement du formulaire
        $forname = $request->get('form-name');
        if ($forname == 'form_accueil') {
           
            // faire ici tous les test et vérifications

            // faire également les enregistrement en bdd


            // si tout va bien passer à l'étape suivante
            return $this->choose_cinema($request);
        }

        // affichage du formulaire        
        return $this->render('modals/modal_accueil.html.twig', [
            'message' => $message,
            'formName' => 'form_accueil',
            'step' => '/modals/accueil',
            'previousStep' => '/modals/new_connection',
        ]);
    }

    #[Route('/choose_cinema', name: 'app_modals_choose_cinema')]
    public function choose_cinema(Request $request): Response
    {
        $message = '';

        // traitement du formulaire
        $forname = $request->get('form-name');
        if ($forname == 'form_choose_cinema') {
           
            // faire ici tous les test et vérifications

            // faire également les enregistrement en bdd


            // si tout va bien passer à l'étape suivante
            return $this->choose_seats($request);
        }

        return $this->render('modals/modal_choose_cinema.html.twig', [
            'message' => $message,
            'formName' => 'form_choose_cinema',
            'step' => '/modals/choose_cinema',
            'previousStep' => '/modals/accueil',        
        ]);
    }

    #[Route('/choose_seats', name: 'app_modals_choose_seats')]
    public function choose_seats(Request $request): Response
    {
        $message = '';

        // traitement du formulaire
        $forname = $request->get('form-name');
        if ($forname == 'form_choose_seats') {
           
            // faire ici tous les test et vérifications

            // faire également les enregistrement en bdd


            // si tout va bien passer à l'étape suivante
            return $this->choose_categories($request);
        }

        return $this->render('modals/modal_choose_seats.html.twig', [
            'message' => $message,
            'formName' => 'form_choose_seats',
            'step' => '/modals/choose_seats',
            'previousStep' => '/modals/choose_cinema',
            
        ]);
    }

    #[Route('/choose_categories', name: 'app_modals_choose_categories')]
    public function choose_categories(Request $request): Response
    {
        $message = '';

        // traitement du formulaire
        $forname = $request->get('form-name');
        if ($forname == 'form_choose_categories') {
           
            // faire ici tous les test et vérifications

            // faire également les enregistrement en bdd


            // si tout va bien passer à l'étape suivante
            return $this->choose_actors($request);
        }
        return $this->render('modals/modal_choose_categories.html.twig', [
            'message' => $message,
            'formName' => 'form_choose_categories',
            'step' => '/modals/choose_categories',
            'previousStep' => '/modals/choose_seats',
            
        ]);
    }

    #[Route('/choose_actors', name: 'app_modals_choose_actors')]
    public function choose_actors(Request $request): Response
    {
        $message = '';

        // traitement du formulaire
        $forname = $request->get('form-name');
        if ($forname == 'form_choose_actors') {
           
            // faire ici tous les test et vérifications

            // faire également les enregistrement en bdd


            // si tout va bien passer à l'étape suivante
            return $this->fidelity($request);
        }
        return $this->render('modals/modal_choose_actors.html.twig', [
            'message' => $message,
            'formName' => 'form_choose_actors',
            'step' => '/modals/choose_actors',
            'previousStep' => '/modals/choose_categories',
        ]);
    }

    #[Route('/fidelity', name: 'app_modals_fidelity')]
    public function fidelity(Request $request): Response
    {
        $message = '';

        // traitement du formulaire
        $forname = $request->get('form-name');
        if ($forname == 'form_fidelity') {
           
            // faire ici tous les test et vérifications

            // faire également les enregistrement en bdd


            // si tout va bien passer à l'étape suivante
            
            return $this->redirectToRoute('app_board', [], Response::HTTP_SEE_OTHER);
        }
        return $this->render('modals/modal_fidelity.html.twig', [
            'message' => $message,
            'formName' => 'form_fidelity',
            'step' => '/modals/fidelity',
            'previousStep' => '/modals/choose_categories',
        ]);
    }
}
