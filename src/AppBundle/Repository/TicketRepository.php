<?php
/**
 * Created by PhpStorm.
 * User: Utilisateur
 * Date: 01/02/2018
 * Time: 15:19
 */

namespace AppBundle\Repository;


use Doctrine\ORM\EntityRepository;

class TicketRepository extends EntityRepository
{
    /**
     * @return array
     */

    public function trouverNombreCriticite($criticite){
        $qb2=$this->createQueryBuilder('t')
            ->select('Count(t)')
            ->where("t.idcriticite = :crit")
            ->setParameter('crit', $criticite)
        ;
        return $qb2->getQuery()->getSingleScalarResult();
    }
}