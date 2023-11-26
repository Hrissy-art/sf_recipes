<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    #[Route('/articles', name: 'list_articles')]
    public function index(ArticleRepository $articleRepository): Response
    {
        $articles = $articleRepository->findAll();
        $cake = "Lorem ipsun";
        return $this->render('article/index.html.twig', [
            'articles' => $articles,
            'recepies' => $cake,
        ]);
    }

    #[Route('/articles/{id}', name: 'item_article')]
    public function item(ArticleRepository $articleRepository, $id): response
    {
        $article = $articleRepository->find($id);
        return $this->render('article/item.html.twig', [
'article' => $article,
        ]);
    }
}
