<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegisterFormType;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class RegisterController extends AbstractController
{
    #[Route(path: '/register', name: 'app_register')]

    public function new(Request $request, UserPasswordHasherInterface $passwordHasher){
        $user = new User();
        $user->setScore(0);
        $user->setChallengeNb(0);
        date_default_timezone_set('Europe/Paris');
        $user->setCreatedAt(new DateTime());

        $form = $this->createForm(RegisterFormType::class, $user);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $user_mdp = $user->getPassword();
            $hashed_pass = $passwordHasher->hashPassword($user,$user_mdp);
            $user->setPassword($hashed_pass);
            $task = $form->getData();
            $em = $this->getDoctrine()->getManager(); // on récupère la gestion des entités
            $em->persist($task); // on effectue les mise à jours internes
            $em->flush(); // on effectue la mise à jour vers la base de données
            return $this->redirectToRoute('app_login'); // on redirige vers la route show_task avec l'id du post créé ou modifié 
        }

        return $this->renderForm('register/register.html.twig', [
            'form' => $form,
        ]);
    }
}
