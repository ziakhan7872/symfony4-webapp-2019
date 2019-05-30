<?php

namespace App\DataFixtures;
use App\Entity\Article;
use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class ArticleFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
    	$category = new Category();
    	$catName = 'Science & Technology';
    	$category->setName($catName);
    	$category->setSlug( strtolower( str_replace(' ', '-',$catName) ) );
    	$manager->persist($category);
		$manager->flush();

        for ($i = 0; $i < 20; $i++) 
         {
			$article = new Article();
			$article->setCategory($category);
			$title = "My article ".$i;

			$article->setTitle($title);
			//$article->setSlug(str_replace(' ','-',$title));
			$article->setDescription('This is article number '.$i);
			$article->setStatus('Active');
			$article->setUserId(2);
			$article->setCreatedAt(date("Y-m-d H:i:s"));
      $article->setUpdatedAt(date("Y-m-d H:i:s"));
      $article->setImage('no-image.png');
      $article->setTag('custome_tag ');
      $article->setSlug('article_slug');
      $article->setVoteUp('like');
      $article->setVoteDown('deslike');
  		$manager->persist($article);
			$manager->flush();
   		 }

    }
}
