<?php

namespace AppBundle\Repository;

/**
 * ArticlesRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ArticlesRepository extends \Doctrine\ORM\EntityRepository
{

  public function findArticleswithName(){
    $query = $this->createQueryBuilder('a')
    ->select("a.id, a.title, a.content, a.userId, u.name")
    ->leftJoin('AppBundle:Users', 'u', \Doctrine\ORM\Query\Expr\Join::WITH, 'a.userId = u.id')
    ->getQuery();
    return $query->getArrayResult();
  }
}
