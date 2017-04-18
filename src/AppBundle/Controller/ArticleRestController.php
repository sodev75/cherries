<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response as Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\ViewHandler;
use FOS\RestBundle\View\View;
use AppBundle\Entity\Articles;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

class ArticleRestController extends Controller
{

  /**
    * @ApiDoc(
    *    description="Récupère la liste des articles"
    * )
    *
    *
   * @Rest\Get("/articles")
   */
    public function getArticleAction(Request $request)
    {
      $articles = $this->get('doctrine.orm.entity_manager')
                ->getRepository('AppBundle:Articles')
                ->findArticleswithName();

      if (empty($articles)) {
        return new JsonResponse(['message' => "Aucun article"], Response::HTTP_NOT_FOUND);
      }
      return new JsonResponse($articles);

    }


}
