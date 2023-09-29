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
use DateTime;
use Doctrine\ORM\Mapping\Id;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\Date;

class UserChallengeController extends AbstractController
{
    #[Route(path: '/challenge/{id}/added', name: 'app_added')]
    public function add(Request $request, $id)
    {
        $user_challenge = new UserChallenge();
        $defis = $this->getDoctrine()->getRepository(Challenge::class)->find($id);
        $user = $this->getUser(); 
        date_default_timezone_set('Europe/Paris');
        $date = new DateTime();
        $defisDelai = $defis->getDeadline();
        date_add($date,date_interval_create_from_date_string($defisDelai."days"));
        
        $user_challenge->setChallenge($defis);
        $user_challenge->setStatut('Accepted');
        $user_challenge->setUser($user);
        $user_challenge->setDateFinObligatoire($date);

        
        $em = $this->getDoctrine()->getManager();
        $em->persist($user_challenge);
        $em->flush();
        
        return $this->redirectToRoute('app_home', ['id' => $defis->getId()]
    );
    }

    #[Route(path: '/account/{id}/{challScore}/confirm', name: 'app_confirm')]
    public function confirm(Request $request, $id, $challScore)
    {
        $defis = $this->getDoctrine()->getRepository(UserChallenge::class)->find($id);
        $user = $this->getUser();

        $defis->setStatut('Confirmed');
        $user->setScore($challScore + $user->getScore());
        
        $em = $this->getDoctrine()->getManager();
        $em->persist($defis);
        $em->persist($user);
        $em->flush();
        
        return $this->redirectToRoute('app_account', ['id' => $defis->getId()]
    );
    }

}


