<?php

namespace App\DataFixtures;

use App\Entity\ArticleComments;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class ArticleCommentsFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
       
			for ($i = 0; $i < 20; $i++)
    	{

     	$comments = new ArticleComments();
		$comments->setUserId('2');
		$comments->setArticleId('2');
		$comments->setStatus('Active ' .$i);
		$comments->setComment('custom comments ' .$i);
		$comments->setCreatedAt(date("Y-m-d H:i:s"));
		$comments->setUpdatedAt(date("Y-m-d H:i:s"));
        $manager->persist($comments);
        $manager->flush();
    	}
    }
}
