<?php

namespace App\Controller;

use App\Entity\Article;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    public function __construct(EntityManagerInterface $objectManager)
    {
        $this->articleRepository = $objectManager->getRepository(Article::class);
    }

    #[Route('/', name: 'app_article')]
    public function index(): Response
    {
        $allArticle = $this->articleRepository->findAll();
        return $this->render('article/index.html.twig', [
            'controller_name' => 'ArticleController',
            'articles' => $allArticle
        ]);
    }
}
