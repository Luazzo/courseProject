<?php

namespace AppBundle\Repository;

/**
 * PromotionRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class PromotionRepository extends \Doctrine\ORM\EntityRepository
{

    public function findLastPromos($id, $max_results){

        $query = $this->createQueryBuilder('p')
            ->leftJoin("p.provider", "pr")
            ->where("p.category = :id")
            ->orderBy("p.start", "DESC")
            ->setParameter('id',$id)
            ->setMaxResults($max_results);

        return $query->getQuery()->getResult();

    }
}
