<?php

namespace App\Controller;

use App\Entity\Formations;
use App\Form\FormationsType;
use App\Repository\FormationsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

#[Route('/formations')]
class FormationsController extends AbstractController
{

    #[Route('/', name: 'app_formations_index', methods: ['GET'])]   // base est l’URL de la page, name est le nom de la route
    public function index(FormationsRepository $formationsRepository): Response
    {
        return $this->render('formations/index.html.twig', [    // render est la fonction qui va chercher le fichier TWIG pour l’afficher
            'formations' => $formationsRepository->findAll(),
        ]);
    }
    #[Route('/new', name: 'app_formations_new', methods: ['GET', 'POST'])]
    #[IsGranted("ROLE_ADMIN")]

    public function new(Request $request, FormationsRepository $formationsRepository): Response
    {
        $formation = new Formations();
        $form = $this->createForm(FormationsType::class, $formation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $formationsRepository->save($formation, true);

            return $this->redirectToRoute('app_formations_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('formations/new.html.twig', [
            'formation' => $formation,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_formations_show', methods: ['GET'])]
    public function show(Formations $formation): Response
    {
        return $this->render('formations/show.html.twig', [
            'formation' => $formation,
        ]);
    }

    #[IsGranted("ROLE_ADMIN")]

    #[Route('/{id}/edit', name: 'app_formations_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Formations $formation, FormationsRepository $formationsRepository): Response
    {
        $form = $this->createForm(FormationsType::class, $formation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $formationsRepository->save($formation, true);

            return $this->redirectToRoute('app_formations_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('formations/edit.html.twig', [
            'formation' => $formation,
            'form' => $form,
        ]);
    }
    #[IsGranted("ROLE_ADMIN")]

    #[Route('/{id}', name: 'app_formations_delete', methods: ['POST'])]

    public function delete(Request $request, Formations $formation, FormationsRepository $formationsRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$formation->getId(), $request->request->get('_token'))) {
            $formationsRepository->remove($formation, true);
        }

        return $this->redirectToRoute('app_formations_index', [], Response::HTTP_SEE_OTHER);
    }
}
