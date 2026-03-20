<?php

namespace App\Controller;

use App\Entity\Fromage;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class DeleteController extends AbstractController
{
    #[Route('/delete', name: 'delete')]
    public function delete(Fromage $fromage, Request $request, EntityManagerInterface $entityManager): Response
    {
        if($this->isCsrfTokenValid("SUP". $fromage->getId(),$request->get('_token'))){
            $entityManager->remove($fromage);
            $entityManager->flush();
            $this->addFlash("success","La suppression a été effectuée !");
            return $this->redirectToRoute("accueil");
        }
    }
}
