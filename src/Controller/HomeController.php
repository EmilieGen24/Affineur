<?php

namespace App\Controller;

use App\Repository\FromageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HomeController extends AbstractController
{
    #[Route('/', name: 'accueil')]
    public function index(FromageRepository $repository): Response
    {
        $fromages = $repository ->findAll();
        return $this->render('home/accueil.html.twig', [
            'fromages' => $fromages,
        ]);
    }
}
