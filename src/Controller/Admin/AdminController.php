<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;


/**
 * @Security("is_granted('ROLE_ADMIN')")
 * @Route("/admin")
 */

class AdminController extends AbstractController
{

	/**
     * @Route("/dashboard", name="admin_dashboard", methods={"GET"})
     */
    public function index(): Response
    {
        return $this->render('admin/dashboard/dashbaord.html.twig');
    }

}


