<?php

namespace App\Controller;

use App\Repository\FromageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class FicheController extends AbstractController
{
    #[Route('/fiche', name: 'fiche')]
    public function index(FromageRepository $repository): Response
    {
        $fromages = $repository ->findAll();
        return $this->render('fiche/fiche.html.twig', [
            'fromages' => $fromages,
        ]);
    }
}
