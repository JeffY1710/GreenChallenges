<?php

namespace App\Controller;

use App\Entity\Challenge;
use App\Entity\User;
use App\Entity\UserChallenge;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AccountController extends AbstractController
{
    #[Route(path: '/account', name: 'app_account')]
    public function show()
    {
        $user = $this->getUser();
        // dump($this->getUser()->getId(), $this->getUser()->getChallenges());die;
        return $this->render('account/account.html.twig', [
            'user' => $user,
        ]);
    }
}
