<?php

// src/Controller/Api/AdminController.php

namespace App\Controller\Api;

use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\user;
use App\Repository\UserRepository;


class AdminController extends AbstractFOSRestController
{

	

	public function __construct()
	{

	}

	/**
     * Creates an User resource
     * @Rest\GET("/users")
     * @param Request $request
     * @return View
     */

   public function getUsers(Request $request, UserRepository $userRepository): View
    {
    	 $user = $this->getUser();
        if(!in_array('ROLE_ADMIN',$user->getRoles()))
        {
            return View::create(['message'=>'you are not autheriozed'], Response::HTTP_UNAUTHORIZED);
    	
        }


    	$users = $userRepository->findAll();

    	return View::create($users, Response::HTTP_CREATED);
    }
}