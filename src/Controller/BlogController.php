<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class BlogController extends AbstractController
{
    /**
     * @Route("/blog", name="blog", methods={"GET"})
     */
    public function index(ArticleRepository $articleRepository, Request $request): Response
    {
		echo $request->query->get('categorie');
        return $this->render('blog/index.html.twig', [
			'articles' => $request->query->get('categorie') == null ? $articleRepository->findAll() : $articleRepository->findByCategorieField($request->query->get('categorie')),
        ]);
    }
}
