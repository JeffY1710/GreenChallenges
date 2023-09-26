<?php

namespace App\Controller;

use App\Entity\Challenge;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class NewChallengeController extends AbstractController{

/**
     * @Route("/challenge/create", name="app_challenge/create")
     */

  public function new(Request $request){
    $challenge = new Challenge();
    
    $form = $this->createFormBuilder($challenge)
    ->add('title', TextType::class)
    ->add('category', TextType::class)
    ->add('description', TextType::class)
    ->add('deadline', IntegerType::class)
    ->add('points', IntegerType::class)
    ->add('save', SubmitType::class, array('label' => 'Create Challenge'))
    ->getForm();


    $form->handleRequest($request); // hydratation du form 
    if($form->isSubmitted() && $form->isValid()){ // test si le formulaire a été soumis et s'il est valide
      $em = $this->getDoctrine()->getManager(); // on récupère la gestion des entités
      $em->persist($challenge); // on effectue les mise à jours internes
      $em->flush(); // on effectue la mise à jour vers la base de données
      return $this->redirectToRoute('show_task', ['id' => $task->getId()]); // on redirige vers la route show_task avec l'id du post créé ou modifié 
    }


   

    return $this->render('challenge/create.html.twig', array(
      'form' => $form->createView(),
  ));
  }
}