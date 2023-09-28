<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use App\Entity\Challenge; // Assurez-vous d'importer votre entité Defi
use App\Entity\User;
use App\Entity\UserChallenge;
use App\Form\AddUserChallenge;
use Doctrine\ORM\Mapping\Id;
use Symfony\Component\HttpFoundation\Request;

class UserChallengeController extends AbstractController
{
    #[Route(path: '/challenge/{id}/added', name: 'app_added')]
    public function index(Request $request, $id)
    {
        $user_challenge = new UserChallenge();
        $defis = $this->getDoctrine()->getRepository(Challenge::class)->find($id);
        $allUsers = $this->getDoctrine()->getRepository(User::class)->findAll();

        foreach ($allUsers as $user) { 
            if ($user == $this->getUser()){
                $userId = $user->getId();
            }
        }

        $defisDelai = $defis->getDeadline();
        $defisId = $defis->getId();

        $user_challenge->setChallenge($defisId);
        $user_challenge->setStatut('Accepted');
        $user_challenge->setUser($userId);
        $user_challenge->setDateFinObligatoire($defisDelai);

        
        $form = $this->createForm(AddUserChallenge::class, $defis);
        
        $form->handleRequest($request);
        $em = $this->getDoctrine()->getManager();
        $em->persist($defis);
        $em->flush();
        
        return $this->redirectToRoute('app_home', ['id' => $defis->getId()]
    );
    }

}


