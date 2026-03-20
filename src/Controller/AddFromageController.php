<?php

namespace App\Controller;

use App\Entity\Fromage;
use App\Form\FromageType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class AddFromageController extends AbstractController
{
    #[Route('/add/fromage', name: 'add_fromage')]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        $fromage = new Fromage();
        $form = $this->createForm(FromageType::class, $fromage);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $entityManager->persist($fromage);
            $entityManager->flush();
            $this->addFlash('success-add','Votre fiche est ajoutée avec succès !');
            return $this->redirectToRoute('fiche');
        }
        return $this->render('add_fromage/add_fromage.html.twig', [
            'fromageform' => $form->createView(),
        ]);
    }
}
