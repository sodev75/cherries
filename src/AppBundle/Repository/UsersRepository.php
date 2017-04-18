<?php

namespace AppBundle\Repository;

/**
 * UsersRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class UsersRepository extends \Doctrine\ORM\EntityRepository
{
  public function findUserByIdWithComments($id){

    $query = $this->createQueryBuilder('u')
    //  ->select('u.name', 'u.comments' 'c.id','c.comment')
      ->where(" u.id = :id")
      //->leftJoin('AppBundle:Comments', 'c', \Doctrine\ORM\Query\Expr\Join::WITH, 'c.userId = u.id')
      //  ->leftJoin('AppBundle:Comments', 'c')
      //  ->addSelect('c')
        ->setParameter('id', $id)
      //  ->groupBy("u.id")
        ->getQuery();
        return $query->getResult();

  }
}