<?php

namespace App\DataFixtures;

use App\Entity\Tag;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class TagFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
    	for ($i = 0; $i < 20; $i++)
    	{

     	$Tag = new Tag();
		$Tag->setName('Custom Tag_' .$i);
		$Tag->setSlug('custom_tag_' .$i);
        $manager->persist($Tag);
        $manager->flush();
    	}
    }
}
