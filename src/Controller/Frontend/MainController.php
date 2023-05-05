<?php

namespace App\Controller\Frontend;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #[Route('/', name: 'homepage', methods: ['GET'])]
    public function index(): Response
    {
        $données = ['Pierre', 'Paul', 'Jacques'];

        return $this->render('main/index.html.twig', [
            'données' => $données,
            "name" => 'Paul'
            
        ]);
    }
}
