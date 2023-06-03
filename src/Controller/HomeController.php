<?php

namespace App\Controller;

use App\Repository\FormationsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]         // base est l’URL de la page, name est le nom de la route
    public function index(FormationsRepository $formationsRepository): Response
    {   // render est la fonction qui va chercher le fichier TWIG pour l’afficher
        
        return $this->render('home/home.html.twig', [   
            'formations' => $formationsRepository ->findBy(
                [],
                ['name'=>'asc']
            )
        ]);
    }
}
