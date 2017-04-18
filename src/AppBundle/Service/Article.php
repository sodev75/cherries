<?php

namespace AppBundle\Service;

use GuzzleHttp\Client;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Router;
use Symfony\Component\HttpFoundation\RequestStack;

class Article {

  protected $em;
  protected $requestStack;

  public function __construct(\Doctrine\ORM\EntityManager $em, $router, RequestStack $requestStack)
  {
    $this->em = $em;
    $this->router= $router;
    $this->requestStack = $requestStack;
  }


  // return api articles with guzzle
  public function getAllArticles(){

    $client = new Client();
    $res = $client->get($_SERVER["SERVER_NAME"].'/api/articles');
    if($res->getStatusCode() == "200"){
      $articles=  $res->getBody()->getContents();
    }
    $articlesWithComment = json_decode($articles);
    foreach ($articlesWithComment as $article) {
    //  var_dump($article); die;
      $comments = $this->em->getRepository('AppBundle:Comments')->findLastCommentPerArticle($article->id);
      $article->comments = $comments;
    }
    return $articlesWithComment;
  }

}
