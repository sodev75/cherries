<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;


class DefaultController extends Controller
{
    /**
     * @Route("/", name="index")
     */
    public function indexAction(Request $request)
    {
      // replace this example code with whatever you need
            return $this->render('default/index.html.twig', array(
                'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
            ));
    }

    /**
     * @Route("/user/{id}", name="profile")
     */
    public function profileAction($id)
    {
      $followers = $this->get('doctrine.orm.entity_manager')
                ->getRepository('AppBundle:Friends')
                ->findByFollowing($id);
      $count= count($followers);

      return $this->render('default/profile.html.twig', array(
          "count" => $count, "id" => $id
      ));
      //return new Response($count);

    }

    /**
     * @Route("/articles", name="list")
     */
    public function listAction()
    {
      $service = $this->container->get('app.articles');
      $articles = $service->getAllArticles();
      return $this->render('default/list.html.twig', array( "articles" => $articles
      ));

    }

}
