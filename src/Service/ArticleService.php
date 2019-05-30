<?php

namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\Pagerfanta;
use App\Repository\ArticleRepository;
use App\Utils\Slugger;
use App\Entity\Article;

use App\Repository\CategoryRepository;

final class ArticleService
{

    private $articleRepositoryObj;
    private $categoryRepositoryObj;
    private $emObj;

    public function __construct(ArticleRepository $articleRepositoryObjDependencyInjection, CategoryRepository $categoryRepository,  EntityManagerInterface $em)
    {

        $this->articleRepositoryObj = $articleRepositoryObjDependencyInjection;
        $this->categoryRepositoryObj = $categoryRepository;
    
    	$this->emObj = $em;
    }


    public function getArticlesList()
    {
        $articles = $this->articleRepositoryObj->findAll();
        return $articles;

    }


    public function addArticle($params)
    {

    	$article = new Article();

       	$user = $params['user'];

       	$userid = $user->getId();
        $article->setUserId($userid);

        $category_id = $params['category_id'];
        $category = $this->categoryRepositoryObj->find($category_id);
        $article->setCategory($category);

        $article->setCreatedAt(date("Y-m-d H:i:s"));
        $article->setUpdatedAt(date("Y-m-d H:i:s"));
         
        $title = $params['title'];
        $slug = str_replace(" ", "-", $title);
        $article->setTitle($title);
        $article->setSlug($slug);
        $article->setTag($params['tag']);
        $article->setImage($params['image']);
        $article->setDescription($params['description']);

        $this->emObj->persist($article);
        $this->emObj->flush();

        return $article;

    }



     public function updateArticle(int $articleId, string $title, string $content): ?Article
    {
        $article = $this->articleRepositoryObj->find($articleId);
        if (!$article)
        {
            return null;
        }
			//$article->setCategory($categoty_id);
			$article->setTitle($title);
			$article->setDescription($title);
			//$article->setContent($content);

	        $this->emObj->persist($article);
	        $this->emObj->flush();
        	return $article;
    }

    public function deleteArticle(int $articleId): void
    {
		$article = $this->articleRepositoryObj->find($articleId);
        if ($article) 
        {
           $this->emObj->remove($article);
    	   $this->emObj->flush();
        }
    }

   public function getArticles($id){
    	
    	return $this->articleRepositoryObj->findBy(['id'=>$id]);
    }
}