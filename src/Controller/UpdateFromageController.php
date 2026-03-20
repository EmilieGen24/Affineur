<?php

namespace App\Controller;

use App\Entity\Fromage;
use App\Form\FromageType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class UpdateFromageController extends AbstractController
{
    #[Route('/update/fromage', name: 'update_fromage')]
    public function modify(Fromage $fromage, Request $request, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(FromageType::class, $fromage);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $entityManager->persist($fromage);
            $entityManager->flush();
            $this->addFlash('success-modif','La fiche a été modifiée avec succès !');
            return $this->redirectToRoute('fiche');
        }
        return $this->render('update_fromage/update_fromage.html.twig', [
            'fromageform' => $form->createView(),
        ]);
    }
}
