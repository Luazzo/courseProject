<?php

namespace AppBundle\Repository;

/**
 * ProviderRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ProviderRepository extends \Doctrine\ORM\EntityRepository
{

    public function bestProviders($max_results)
    {
        $query = $this->createQueryBuilder('p')
            ->innerJoin("p.ratings", "r")
            ->select("p as provider","avg(r.note) as note_avg")
            ->orderBy("note_avg", "DESC")
            ->groupBy("p")
            ->setMaxResults($max_results);

        return $query->getQuery()->getResult();

    }
}
