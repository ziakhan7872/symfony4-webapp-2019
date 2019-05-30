<?php

// src/Controller/Api/ArticleController.php

namespace App\Controller\Api;

use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Service\ArticleService;
use App\Repository\ArticleRepository;
use App\Entity\Article;
use App\Entity\user;

//use App\Repository\CategoryRepository;

class ArticleController extends AbstractFOSRestController
{

	private $articleServiceObject;
    private $articleRepository;

	public function __construct(ArticleService $articleServiceObjectInjection){

		$this->articleServiceObject = $articleServiceObjectInjection;
	}

	/**
     * Creates an Article resource
     * @Rest\GET("/articles")
     * @param Request $request
     * @return View
     */
    #1st method to get articles , not recommended
    /*public function getArticles(Request $request, ArticleRepository $articleRepository): View
    {
    	$articles = $articleRepository->findAll();

    	return View::create($articles, Response::HTTP_CREATED);
    }
	*/
	#2nd method to get articles, highly recommneded
	public function getArticles(Request $request): View
    {

    	$articles = $this->articleServiceObject->getArticlesList();

        

    	return View::create($articles, Response::HTTP_OK);
    }


	/**
     * Creates an Article resource
     * @Rest\Post("/articles")
     * @param Request $request
     * @return View
     */
   // public function postArticles(Request $request, ArticleRepository $articleRepository, CategoryRepository $categoryRepository): View
    public function postArticles(Request $request): View
    {

        $params = json_decode($request->getContent(), true);
        $params['user'] = $this->getUser();
        
        $responseArticle = $this->articleServiceObject->addArticle($params);
        return View::create($responseArticle, Response::HTTP_CREATED);
    }


    /**
     * Replaces Article resource
     * @Rest\Put("/articles/{articleId}")
     */
    public function putArticle(int $articleId, Request $request): View
    {
        $article = $this->articleServiceObject->updateArticle($articleId,
            //$request->get('categoty_id'),
            $request->get('title'),
            $request->get('description')
           //$request->get('user_id')
            );
    
        return View::create($article, Response::HTTP_OK);
    }

   
    /**
     * Removes the Article resource
     * @Rest\Delete("/articles/{articleId}")
     */
   public function deleteArticle(int $articleId): View
    {
        $this->articleServiceObject->deleteArticle($articleId);
        return View::create([], Response::HTTP_NO_CONTENT);
    }

     /**
     * Retrieves a Article resource
     * @Rest\Get("/articles/{id}")
     */
    public function getArticle(Request $request, $id): View
    {
        $article = $this->articleServiceObject->getArticles($id);
        return View::create($article, Response::HTTP_OK);
    }
}