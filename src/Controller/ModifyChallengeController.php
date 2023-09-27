<?php

// src/Controller/ModifyChallengeController.php
namespace App\Controller;

use App\Entity\Challenge;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ModifyChallengeController extends AbstractController
{
    /**
     * @Route("/challenge/{id}/modify", name="app_challenge/modify")
     */
    public function modify(Request $request, $id)
    {
        // Récupérez le défi à partir de l'ID
        $em = $this->getDoctrine()->getManager();
        $challenge = $em->getRepository(Challenge::class)->find($id);

        if (!$challenge) {
            throw $this->createNotFoundException('Challenge not found');
        }

        // Créez un formulaire de modification pour ce défi
        $form = $this->createFormBuilder($challenge)
            ->add('title', TextType::class, [
                'label' => 'Titre',
            ])
            ->add('category', TextType::class, [
                'label' => 'Catégorie',
            ])
            ->add('description', TextType::class, [
                'label' => 'Description',
            ])
            ->add('deadline', IntegerType::class, [
                'label' => 'Délai à respecter',
            ])
            ->add('points', IntegerType::class, [
                'label' => 'Nombre de points',
            ])
            ->add('save', SubmitType::class, ['label' => 'Sauvegarder les changements'])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($challenge);
            $em->flush();

            return $this->redirectToRoute('app_challenge/modify', ['id' => $challenge->getId()]);
        }

        return $this->render('challenge/modify.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
