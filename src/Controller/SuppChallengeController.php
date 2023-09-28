<?php

// src/Controller/SuppChallengeController.php

namespace App\Controller;

use App\Entity\Challenge;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SuppChallengeController extends AbstractController
{
    
    #[Route(path: '/challenge/delete/{id}', name: 'app_challenge_delete')]

     
    public function delete(int $id): Response
    {
        // Récupérez le challenge à supprimer depuis la base de données
        $challenge = $this->getDoctrine()->getRepository(Challenge::class)->findOneBy(['id' => $id]);

        
        if (!$challenge) {
            throw $this->createNotFoundException('Challenge non trouvé');
        }

        // Supprimez le challenge
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($challenge);

        $entityManager->remove($challenge);
        $entityManager->flush();

        // Redirigez l'utilisateur vers une page appropriée (par exemple, la liste des challenges)
        return $this->redirectToRoute('app_home');
    }
}
