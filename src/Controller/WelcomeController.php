<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Article;
use App\Entity\User;
use App\Entity\ArticleComments;
use App\Form\ArticleCommentsType;
use Symfony\Component\HttpFoundation\JsonResponse;


class WelcomeController extends AbstractController
{
    /**
     * @Route("/", name="welcome")
     */
    public function index()
    {
      //  $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $repository = $this->getDoctrine()->getRepository(Article::class);
        $data = $repository->findBy(array('status'=>'Active'), 
           	array('id'=>'DESC'));
        return $this->render('welcome/index.html.twig', [
            'articles' => $data,
        ]);
    }
    /**
     * @Route("/detail/{slug}", name="article_detail", methods={"GET"})
     */
    public function detail(Request $request, $slug) 
    {

            //form build
        $articleComment = new ArticleComments();
        $form = $this->createForm(ArticleCommentsType::class, $articleComment);
        $form->handleRequest($request);
        $repository = $this->getDoctrine()->getRepository(Article::class);
    	$singleItem = $repository->find($slug);
        $repositorycomments = $this->getDoctrine()->getRepository(ArticleComments::class);
        $comments = $repositorycomments->findBy(['article_id' => $slug],['id' => 'DESC']
            );
    	return $this->render('welcome/article-detail.html.twig', [
            'item' => $singleItem ,
            'comments'=>$comments,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/save/comment", name="save_comment", methods={"POST"})
     */
    public function saveComment(Request $request)
    {
        
        $articleComment = new ArticleComments();
        $form = $this->createForm(ArticleCommentsType::class, $articleComment);
        
        if ($request->isMethod('POST')) {

            $form->submit($request->request->get($form->getName()));
           //  die("here");
            if ($form->isSubmitted()) {
                
                $postedData = $form->getData();
                //print_r($_POST);
                //exit;

                $user = $this->getUser();

                $userid = $user->getId();
                 // die("here");
                $articleComment->setUserId($userid);

                $article_id = $_POST['article_id'];
                $articleComment->setArticleId($article_id);   
                
                $articleComment->setCreatedAt(date("Y-m-d H:i:s"));
                $articleComment->setUpdatedAt(date("Y-m-d H:i:s"));
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($articleComment);
                $entityManager->flush();
               
                return $this->redirectToRoute('article_detail', ['slug'=>$article_id]);
            }
            else{
                die("Form is not valid");
            }
        }
        return $this->redirectToRoute('welcome');
    }

    /**
    * @Route("/article/up/vote", name="up_vote", methods={"POST"})
    */

    public function voteUp(Request $request)
    {
    
        $id = $request->request->get('article_id');
        $entityManager = $this->getDoctrine()->getManager();
        $article = $entityManager->getRepository(Article::class)->find($id);
        $existingVote = $article->getVoteUp() + 1;
        $article->setVoteUp($existingVote);
        $entityManager->persist($article);
        $entityManager->flush();
        return new JsonResponse(['status'=>true,'voteUp'=>$article->getVoteUp()]
        );
    }
   /**
    * @Route("/article/down/vote", name="down_vote",   methods={"POST"})
    */

    public function downVote(Request $request)
    {
        $id = $request->request->get('article_id');
        $entityManager = $this->getDoctrine()->getManager();
        $article = $entityManager->getRepository(Article::class)->find($id);
        $existingVote = $article->getVoteDown() +1;
        $article->setVoteDown($existingVote);
        $entityManager->persist($article);
        $entityManager->flush();
        return new JsonResponse(['status'=>true,'votedown'=>$article->getVoteDown()]);
    }
}

