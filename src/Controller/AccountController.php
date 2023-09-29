<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AccountController extends AbstractController
{
    #[Route(path: '/account', name: 'app_account')]
    public function show()
    {
        $user_connected = $this->getUser();

        if (!$user_connected) {
            throw $this->createNotFoundException('Aucun utilisateur connecté.');
        }

        $username = $user_connected->getUsername();
        $birthday = $user_connected->getBirthday();
        $email = $user_connected->getEmail();
        $createdAt = $user_connected->getCreatedAt();

        return $this->render('account/account.html.twig', [
            'username' => $username,
            'birthday' => $birthday,
            'email' => $email,
            'created_at' => $createdAt,
        ]);
    }
}
