<?php

namespace App\Controller;

use App\Entity\Formations;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/eleves', name: 'eleves_')]
class FormationsElevesController extends AbstractController
{
    #[Route('/{name}', name: 'list')]   
    public function list(Formations $formation): Response
    {
        // on va chercher la liste des élèves de chaque formation
        $users = $formation->getUsers();
// render est la fonction qui va chercher le fichier TWIG pour l’afficher
        return $this->render('formations/list.html.twig', compact('formation', 'users'));
    }   

}
