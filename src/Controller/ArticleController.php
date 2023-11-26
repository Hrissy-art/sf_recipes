<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\ArticleType;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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

    #[Route('/articles/{id<\d+> ', name: 'item_article')]
    public function item(ArticleRepository $articleRepository, $id): response
    {
        $article = $articleRepository->find($id);
        return $this->render('article/item.html.twig', [
'article' => $article,
        ]);
    }

    #[Route('/articles/new',name: 'new_article' )]
    public function new(Request $request, EntityManagerInterface $em) : Response
 
    {
        $article = new Article();

        $form = $this->createForm(ArticleType::class, $article);
        $form -> handlerequest($request);

if ($form ->isSubmitted() && $form ->isValid())
{
    $em->persist($article);
    $em-> flush();

    return $this ->redirectToRoute('home');
}
return $this->renderForm("article/new.html.twig",
        ['article_form' => $form]);
    }

}
