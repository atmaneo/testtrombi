<?php

namespace App\Controller;

use App\Repository\FormationsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(FormationsRepository $formationsRepository): Response
    {
        return $this->render('home/home.html.twig', [
            'formations' => $formationsRepository ->findBy(
                [],
                ['name'=>'asc']
            )
        ]);
    }
}
