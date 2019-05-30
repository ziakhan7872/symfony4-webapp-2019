<?php

namespace App\Controller;

use App\Entity\ArticleComments;
use App\Form\ArticleCommentsType;
use App\Repository\ArticleCommentsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/article/comments")
 */
class ArticleCommentsController extends AbstractController
{
    /**
     * @Route("/", name="article_comments_index", methods={"GET"})
     */
    public function index(ArticleCommentsRepository $articleCommentsRepository): Response
    {

        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        return $this->render('article_comments/index.html.twig', [
            'article_comments' => $articleCommentsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="article_comments_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $articleComment = new ArticleComments();
        $form = $this->createForm(ArticleCommentsType::class, $articleComment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $user = $this->getUser();
            $userid = $user->getId();
            $articleComment->setUserId($userid);
            echo $userid;
             exit;


            
            $articleComment->setCreatedAt(date("Y-m-d H:i:s"));
            $articleComment->setUpdatedAt(date("Y-m-d H:i:s"));
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($articleComment);
            $entityManager->flush();
           

           

            return $this->redirectToRoute('article_comments_index');
        }

        return $this->render('article_comments/new.html.twig', [
            'article_comment' => $articleComment,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="article_comments_show", methods={"GET"})
     */
    public function show(ArticleComments $articleComment): Response
    {
        return $this->render('article_comments/show.html.twig', [
            'article_comment' => $articleComment,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="article_comments_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, ArticleComments $articleComment): Response
    {
        $form = $this->createForm(ArticleCommentsType::class, $articleComment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('article_comments_index', [
                'id' => $articleComment->getId(),
            ]);
        }

        return $this->render('article_comments/edit.html.twig', [
            'article_comment' => $articleComment,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="article_comments_delete", methods={"DELETE"})
     */
    public function delete(Request $request, ArticleComments $articleComment): Response
    {
        if ($this->isCsrfTokenValid('delete'.$articleComment->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($articleComment);
            $entityManager->flush();
        }

        return $this->redirectToRoute('article_comments_index');
    }
}
