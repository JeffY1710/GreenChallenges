<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegisterFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class RegisterController extends AbstractController
{
    #[Route(path: '/register', name: 'app_register')]

    public function new(Request $request){
        $user = new User();

        $form = $this->createForm(RegisterFormType::class, $user);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $task = $form->getData();
            $em = $this->getDoctrine()->getManager(); // on récupère la gestion des entités
            $em->persist($task); // on effectue les mise à jours internes
            $em->flush(); // on effectue la mise à jour vers la base de données
            return $this->redirectToRoute('register'); // on redirige vers la route show_task avec l'id du post créé ou modifié 
        }

        return $this->renderForm('register.html.twig', [
            'form' => $form,
        ]);
    }
}
