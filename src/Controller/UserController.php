<?php

namespace App\Controller;

use App\Document\Users;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ODM\MongoDB\DocumentManager;
use App\Document\Users\preferencies;
use App\Repository\UserRepository;
use MongoDB\BSON\ObjectId;





class UserController extends AbstractController
{
 
    // #[Route('/', name: 'app_home')]
    // public function showAction(DocumentManager $dm)
    // {
    //     $product = $dm->getRepository(Users::class)->findAll();

    //     // var_dump($product);
    //     dump($product);
    // }

    // #[Route('/', name: 'app_home')]
    // public function showAction(DocumentManager $dm)
    // {
    //     // $users = $dm->getRepository(Users::class)->findAll();

        // return $this->render('home/index.html.twig', [
        //     'users' => $users,
    
        // ]);
        // $userId = '64ad61aca6c78bec310966e4';
        // $user = $dm->getRepository(Users::class)->find(new App\Controller\ObjectId($userId));
    
        // return $this->render('home/index.html.twig', [
        //     'user' => $user,
        // ]);
    // }

    // #[Route('/', name: 'app_home')]
    // public function showAction(DocumentManager $dm): Response
    // {
    //     $userId = '64ad61aca6c78bec310966e4';
    //     $user = $dm->getRepository(Users::class)->find(new App\Controller\ObjectId($userId));
    //     dump($user);

    //     return $this->render('home/index.html.twig', [
    //         'user' => $user,
    //     ]);
    // }

    #[Route('/', name: 'app_home')]
    public function createAction(DocumentManager $dm)
    {
        $user = new Users();
        $user->setFirstName('Gonta');
        $user->setLastName('Uzumaki');
        $user->setAddress('3 rue des bateaux');
        $user->setCity('Cergy');
        $user->setFidelityPoints('30');
        $user->setPostalCode('95800');
        $user->setPassword('3456567');
        $dm->persist($user);
    
        $dm->flush();
    
        return $this->Render('home/index.html.twig', [
            'user' => $user,

        ]);
    }



 
}