<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegisterType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;

final class RegisterController extends AbstractController
{
    #[Route('/register', name: 'register')]
     public function register(Request $request, EntityManagerInterface $entityManager, UserPasswordHasherInterface $passwordEncoder): Response
    {
        $user = new User();
        $userform = $this->createForm(RegisterType::class, $user);
        $userform->handleRequest($request);
        if ($userform->isSubmitted() && $userform->isValid()){
            $user->setRoles(['ROLE_USER']);
            $user->setPassword($passwordEncoder->hashPassword($user, $userform->get('password')->getData()));
            $entityManager->persist($user);
            $entityManager->flush();
            $this->addFlash('success','Votre compte a été créé avec succès !');
            return $this->redirectToRoute('accueil');
        }
        return $this->render('register/register.html.twig', [
            'userform' =>$userform->createView(),
        ]);
    }
}
