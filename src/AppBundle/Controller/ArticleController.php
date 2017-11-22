<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Article;
use AppBundle\Manager\ArticleManager;
use AppBundle\Form\ArticleType;
use AppBundle\Repository\PostRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/article")
 */
class ArticleController extends Controller
{
    /**
     * @Route("/", name="articles")
     * @Method({"GET"})
     * @return Response
     */
     public function indexAction(Request $request)
     {
          $em = $this->getDoctrine()->getManager();


          if($request->query->get('q')) {
               $articles = $em->getRepository('AppBundle:PostRepository')->findByTag($request->query->get('q'));
          } else {
               $articles = $em->getRepository('AppBundle:Article')->findAll();
          }

          return $this->render('article/index.html.twig', [
               'posts' => $articles
          ]);
     }

     /**
      * @Route("/new", name="create_article")
      * @Method({"GET", "POST"})
      */
     public function createAction(Request $request)
     {
          $article = new Article();
          $form = $this->createForm(ArticleType::class, $article);

          // permet d'associer le formulaire vite avec les données envoyé dans request
          $form->handleRequest($request);
          if($form->isValid()) {
               $em = $this->getDoctrine()->getManager();
               $em->persist($article);
               $em->flush();

               $this->addFlash(
                    'success',
                    "L'article {$article->getTitle()} à été créer."
               );
               return $this->redirectToRoute('articles');
          }

          return $this->render('article/create.html.twig', [
               'article' => $article,
               'form' => $form->createView()
          ]);
     }

     /**
      * @Route("/update/{id}", name="update_article")
      * @Method({"GET", "POST"})
      */
     // public function updateAction(Request $request)
     // {
     //      $article = new Article();
     //      $form = $this->createForm(ArticleType::class, $article);
     //
     //      // permet d'associer le formulaire vite avec les données envoyé dans request
     //      $form->handleRequest($request);
     //      if($form->isValid()) {
     //           $em = $this->getDoctrine()->getManager();
     //           $em->persist($article);
     //           $em->flush();
     //
     //           $this->addFlash(
     //                'success',
     //                "L'article {$article->getTitle()} à été créer."
     //           );
     //           return $this->redirectToRoute('articles');
     //      }
     //
     //      return $this->render('article/create.html.twig', [
     //           'article' => $article,
     //           'form' => $form->createView()
     //      ]);
     // }

     /**
      * @Route("/show/{id}", name="show_article")
      * @Method({"GET"})
      * @param Article $article
      * @return Response
      */
      public function showAction(Article $article)
      {
           return $this->render('article/show.html.twig', [
                'article' => $article
           ]);
      }

      public function publish(Article $article, ArticleManager $articleManager)
      {
           $articleManager->publish($article);
           $this->getDoctrine()->getManager()->flush();
      }

}
