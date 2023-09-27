<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegisterFormType;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class ScoreController extends AbstractController
{
    /**
     * @Route("/scores", name="app_score")
     */

    public function show(Request $request){
        $user_connected = $this->getUser();
        $user = $this->getDoctrine()->getRepository(User::class)->findBy([],['score' => 'DESC'],5);

        return $this->render('score/score.html.twig', array(
            'users' => $user,
            'user_info' => $user_connected
        ));
    }
}
