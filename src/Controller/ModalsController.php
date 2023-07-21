<?php

namespace App\Controller;

use App\Document\User;
use App\Form\UserType;
use App\Repository\CinemasRepository;
use App\Repository\UserRepository;
use DateTime;
use Doctrine\ODM\MongoDB\DocumentManager;
use Doctrine\ODM\MongoDB\Mapping\Annotations\Id;
use PhpParser\Node\Expr\Cast\String_;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


#[Route('/modals')]
class ModalsController extends AbstractController
{
    
    public function __construct()
    {
        if(!isset($_SESSION)){
            session_start();
        }
    }

    #[Route('/new_connection', name: 'app_modals_new_connection')]
    public function new_connection( Request $request, 
                                    UserRepository $userRepository): Response
    {
        
        $user = new User();
        
        $message = '';

        // traitement du formulaire
        $forname = $request->get('form-name');
        if ($forname == 'form_new_connection') {
            $success = true;
            
            // faire ici tous les test et vérifications

            $user->setGender($request->get('gender'));
            
            $lastname = $request->get('lastname');
                if(empty($lastname) || !is_string($lastname)) {
                $success = false;
                    $message .= 'Veuillez entrer votre nom.<br>';
                }
            $user->setLastName($request->get('lastname'));    

            $firstname = $request->get('firstname');
                if (empty($firstname) || !is_string($firstname)) {
                    $success = false;
                    $message .= 'Veuillez entrer votre prénom.<br>';
                }  
            $user->setFirstName($request->get('firstname'));
            
            $user->setDateOfBirth(new DateTime($request->get('dateOfBirth')));

            $password = $request->get('password');
            $checkPassword = $request->get('checkPassword');
                if (empty($password) || empty($checkPassword)) {
                    $success = false;
                        $message .= 'Veuillez entrer votre mot de passe.<br>';
                }  
        
                if ($password !== $checkPassword) {
                        $success = false;
                        $message .= 'La vérification du mot de passe est incorrecte.<br>';
                }

            $user->setPassword($request->get('password'));
            $user->setCheckPassword($request->get('checkPassword'));

            $email = $_POST['email']; 
                if(filter_var($email, FILTER_VALIDATE_EMAIL)){
                    $success = true;
                } else {
                    $success = false;
                    $message .= 'Adresse email invalide.<br>';
                }
                
            $user->setEmail($request->get('email'));

            $user->setPhone($request->get('phone'));
            $user->setAddress($request->get('address'));
            $user->setPostalCode($request->get('postalCode'));
            $user->setCity($request->get('city'));
            $user->setCountry($request->get('country'));
              
            // faire également les enregistrement en bdd
             if ($success) {              
                    $userRepository->save($user, true);
                    // trouver l'id du user
                    $userId = $user->getId();

                    // memorise l'id en session
                    $_SESSION['id'] = $userId;
                }
      
            // si tout va bien passer à l'étape suivante
            if ($success) {
                return $this->accueil($request, $userRepository);
            }
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
    public function accueil(Request $request, 
                            UserRepository $userRepository): Response
    {
    
        // recuperer l'id en session
        $userId = $_SESSION['id'];      

        // faire un find pour retrouver le user
        $user = $userRepository->findUserById($userId);

        $firstname = null;
        $message = null;
        if (!$user) {
           $message = 'Vous n\'êtes pas connecté(e).<br>';
        } else {
            $firstname = $user->getFirstName();
        }

        // traitement du formulaire
        $forname = $request->get('form-name');
        if ($forname == 'form_accueil') {

            // si tout va bien passer à l'étape suivante
            return $this->choose_cinema($request, $userRepository);
        }

        // affichage du formulaire        
        return $this->render('modals/modal_accueil.html.twig', [
            'message' => $message,
            'firstname' => $firstname,
            'formName' => 'form_accueil',
            'step' => '/modals/accueil',
            'previousStep' => '/modals/new_connection',
        ]);
    }

    #[Route('/choose_cinema', name: 'app_modals_choose_cinema')]
    public function choose_cinema(Request $request,
                                UserRepository $userRepository): Response
    {
        $message = '';

         // recuperer l'id en session
         $userId = $_SESSION['id']; 

         // faire un find pour retrouver le user
        $user = $userRepository->findUserById($userId);

        // traitement du formulaire
        $forname = $request->get('form-name');
        if ($forname == 'form_choose_cinema') {
          

        
            // faire également les enregistrement en bdd
     //       $user->setLocation($request->get('location'));

            // si tout va bien passer à l'étape suivante
            return $this->choose_seats($request, $userRepository);
        }

        return $this->render('modals/modal_choose_cinema.html.twig', [
            'message' => $message,
            'formName' => 'form_choose_cinema',
            'step' => '/modals/choose_cinema',
            'previousStep' => '/modals/accueil',        
        ]);
    }

    #[Route('/choose_seats', name: 'app_modals_choose_seats')]
    public function choose_seats(Request $request,
                                UserRepository $userRepository): Response
    {
        $message = '';

        // traitement du formulaire
        $forname = $request->get('form-name');
        if ($forname == 'form_choose_seats') {
           
            // faire ici tous les test et vérifications

            // faire également les enregistrement en bdd


            // si tout va bien passer à l'étape suivante
            return $this->choose_categories($request, $userRepository);
        }

        return $this->render('modals/modal_choose_seats.html.twig', [
            'message' => $message,
            'formName' => 'form_choose_seats',
            'step' => '/modals/choose_seats',
            'previousStep' => '/modals/choose_cinema',
            
        ]);
    }

    #[Route('/choose_categories', name: 'app_modals_choose_categories')]
    public function choose_categories(Request $request,
                                      UserRepository $userRepository): Response
    {
        $message = '';

        // recuperer l'id en session
        $userId = $_SESSION['id']; 

        // faire un find pour retrouver le user
        $user = $userRepository->findUserById($userId);

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
