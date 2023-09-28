<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use App\Entity\Challenge; // Assurez-vous d'importer votre entité Defi

class HomeController extends AbstractController
{
    #[Route(path: '/home', name: 'app_home')]
    public function index(AuthenticationUtils $authenticationUtils): Response
    {
        // Récupérez la liste des défis depuis la base de données
        $defis = $this->getDoctrine()->getRepository(Challenge::class)->findAll();

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('home/home.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error,
            'defis' => $defis, // Ajoutez la liste des défis ici
        ]);
    }



    #[Route('/challenge/{id}', name: 'challenge_detail')]
public function showChallengeDetail($id): Response
{
    // Récupérez le challenge depuis la base de données en fonction de son ID
    $defis = $this->getDoctrine()->getRepository(Challenge::class)->find($id);

    // dump($defis);
    // die;

    if (!$defis) {
        throw $this->createNotFoundException('Challenge non trouvé avec l\'ID : ' . $id);
    }

    return $this->render('challenge/detail.html.twig', [
        'defis' => $defis,
    ]);
}
}


