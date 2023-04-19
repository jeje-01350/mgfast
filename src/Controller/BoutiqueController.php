<?php

namespace App\Controller;

use App\Repository\BoutiqueRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BoutiqueController extends AbstractController
{
    #[Route('/boutique', name: 'app_boutique')]
    public function index(BoutiqueRepository $repo): Response
    {
        $boutique = $repo->findAll();
        return $this->render('boutique/index.html.twig', [
            'controller_name' => 'BoutiqueController',
            'boutiques' => $boutique
        ]);
    }
}
