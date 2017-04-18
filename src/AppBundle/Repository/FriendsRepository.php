<?php

namespace AppBundle\Repository;

/**
 * FriendsRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class FriendsRepository extends \Doctrine\ORM\EntityRepository
{

  public function findFriendsPerComment($userIdComment, $userIdArticle){

    $query = $this->createQueryBuilder('f')
        ->select("COUNT(f.follower) as friendsCount")
        ->where("f.follower = :userIdComment")
        ->andWhere('f.following = :userIdArticle')
        ->setParameter('userIdComment', $userIdComment)
        ->setParameter('userIdArticle', $userIdArticle)
        ->getQuery();
        return $query->getResult();

  }
}
