<?php

namespace App\DataFixtures;

use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\User;
class UserFixtures extends Fixture
{
  private $passwordEncoder;

     public function __construct(UserPasswordEncoderInterface $passwordEncoder)
     {
         $this->passwordEncoder = $passwordEncoder;
     }


    public function load(ObjectManager $manager)
    {
    	#create admin user
        $user = new User();
        $user->setEmail('admin@app.com');
           $user->setPassword($this->passwordEncoder->encodePassword(
             $user,
             '123456'
	     ));
	    $roles[]	=	'ROLE_ADMIN';
	    $user->setRoles($roles);
	    $manager->persist($user);


		#create user
        $user1 = new User();
        $user1->setEmail('user@app.com');
        $user1->setPassword($this->passwordEncoder->encodePassword(
             $user1,
             '123456'
	     ));
	    $roles1[]	=	'ROLE_USER';
	    $user1->setRoles($roles1);
	    $manager->persist($user1);
        $manager->flush();
    }
}
