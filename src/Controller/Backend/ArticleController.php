<?php

namespace App\Controller\Backend;

use App\Entity\Article;
use App\Form\ArticleType;
use App\Repository\ArticleRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;



#[Route('/admin/article', name: 'admin_article')]
class ArticleController extends AbstractController
{
    public function __construct(
        private readonly ArticleRepository $repo
    ) {
    }

    #[Route('', name: '_index', methods: ['GET'])]
    public function index(): Response
    {
        $articles = $this->repo->findAll();
        return $this->render(
            'Backend/Article/index.html.twig',
            [
                'articles' => $articles,
                // peut aussi être écrit de cette façon (en supprimant le $articles = $this->repo->findAll() au dessus)
                // 'articles' => $this->repo-findAll(),
            ]
        );
    }
    #[Route('/create', name: '_create', methods: ['GET', 'POST'])]
    public function create(Request $request): Response
    {
        $article = new Article();

        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->repo->save($article, true);

            $this->addFlash('success', 'Article created successfully');

            return $this->redirectToRoute('admin_article_index');
        }


        return $this->render('Backend/Article/create.html.twig', [
            'form' => $form
        ]);
    }
}