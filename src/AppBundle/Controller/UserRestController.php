<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use AppBundle\Entity\Users;
use FOS\RestBundle\Controller\Annotations\Version;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use FOS\RestBundle\Controller\Annotations\QueryParam;

/**
* @Version({"v1", "v2", "v3", "v4"})
*/
class UserRestController extends Controller
{

   /**
   * @ApiDoc(
   *    description="Récupère les informations d'un utilisateur",
     *    output= { "class"=Users::class, "collection"=true, "groups"={"users"} }
   * )
   * @QueryParam(name="version", requirements="\d+", default="", description="Version de l'api v1, v2, v3 ou v4")
   *
   * @Rest\Get("/users/{id}")
   */
   public function getUsersAction($id, Request $request)
   {

     $version = $request->query->get('version');
     $v1params = [
       "users" => "name",
     ];
     $v2params = [
        "users" => "name",
         "comments" => "c.id, c.comment"
       ];
     $v3params = [
       "users" => "name",
       "comments" => "c.id"
     ];
     $v4params = [
       "users" => "name",
        "comments" => "c.id, c.comment"
     ];

     $params = "params";

     $return = $this->getUserApiVersion($id, $version, ${$version.$params});

     if (empty($return)) {
       return new JsonResponse(['message' => "Aucun utilisateur à l'identifiant n° $id"], Response::HTTP_NOT_FOUND);
     }
     return new JsonResponse($return);

   }
   protected function getUserApiVersion($id, $version, $params){
     $formated = [];
     $user = $this->get('doctrine.orm.entity_manager')
               ->getRepository('AppBundle:Users')
               ->find($id);

    if(is_string($params['users'])){
      $formated["name"]= $user->getName();
    }

     if($version !== "v1"){
       $comments = $this->get('doctrine.orm.entity_manager')
                 ->getRepository('AppBundle:Comments')
                 ->findCommentByUser($id, $params['comments']);
       $formated["comments"] =  $comments;
     }
     return $formated;
   }


}
