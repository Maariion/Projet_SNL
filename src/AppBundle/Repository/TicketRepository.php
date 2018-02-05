<?php
/**
 * Created by PhpStorm.
 * User: Utilisateur
 * Date: 01/02/2018
 * Time: 15:19
 */

namespace AppBundle\Repository;


use Doctrine\ORM\EntityRepository;
use AppBundle\Repository\UtilisateurRepository;

class TicketRepository extends EntityRepository
{
    /**
     * @return un seul chiffre
     */

    public function trouverNombreCriticite($criticite){
        $qb1=$this->createQueryBuilder('t')
            ->select('Count(t)')
            ->where("t.idcriticite = :crit")
            ->setParameter('crit', $criticite)
        ;
        return $qb1->getQuery()->getSingleScalarResult();
    }

    /**
     * @return un seul chiffre
     */

    public function trouverNombreStatut($statut){
        $qb2=$this->createQueryBuilder('t')
            ->select('Count(t)')
            ->where("t.idstatut = :statu")
            ->setParameter('statu', $statut)
        ;
        return $qb2->getQuery()->getSingleScalarResult();
    }

    /**
     * @return un seul chiffre
     */

    public function trouverNombreOrganisation($organisation){
        $qb3=$this->createQueryBuilder('t')
            ->select('Count(t)')
            ->where("t.idutilClient IN(:organ)")
            ->setParameter('organ', array_values(trouverUtilisateurLieOrganisation($organisation)))
        ;
        return $qb3->getQuery()->getSingleScalarResult();
    }
}