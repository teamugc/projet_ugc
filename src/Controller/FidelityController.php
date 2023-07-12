<?php

namespace App\Controller;

use App\Document\Fidelity;
use App\Form\FidelityType;
use App\Repository\FidelityRepository;
use Doctrine\ODM\MongoDB\DocumentManager as MongoDBDocumentManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/fidelity')]
class FidelityController extends AbstractController
{
    #[Route('/', name: 'app_fidelity_index', methods: ['GET'])]
    public function index(FidelityRepository $fidelityRepository): Response
    {
        return $this->render('fidelity/index.html.twig', [
            'fidelities' => $fidelityRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_fidelity_new', methods: ['GET', 'POST'])]
    public function new(Request $request, MongoDBDocumentManager $documentManager): Response
    {
        $fidelity = new Fidelity();
        $form = $this->createForm(FidelityType::class, $fidelity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $documentManager->persist($fidelity);
            $documentManager->flush();

            return $this->redirectToRoute('app_fidelity_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('fidelity/new.html.twig', [
            'fidelity' => $fidelity,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_fidelity_show', methods: ['GET'])]
    public function show(Fidelity $fidelity): Response
    {
        return $this->render('fidelity/show.html.twig', [
            'fidelity' => $fidelity,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_fidelity_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Fidelity $fidelity, MongoDBDocumentManager $documentManager): Response
    {
        $form = $this->createForm(FidelityType::class, $fidelity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $documentManager->flush();

            return $this->redirectToRoute('app_fidelity_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('fidelity/edit.html.twig', [
            'fidelity' => $fidelity,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_fidelity_delete', methods: ['POST'])]
    public function delete(Request $request, Fidelity $fidelity, MongoDBDocumentManager $documentManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$fidelity->getId(), $request->request->get('_token'))) {
            $documentManager->remove($fidelity);
            $documentManager->flush();
        }

        return $this->redirectToRoute('app_fidelity_index', [], Response::HTTP_SEE_OTHER);
    }
}
