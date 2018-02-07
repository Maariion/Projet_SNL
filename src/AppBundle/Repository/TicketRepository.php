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
use Symfony\Component\HttpFoundation\Request;

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

    public function trouverNombreOrganisation($clients){
        $qb3=$this->createQueryBuilder('t')
            ->select('Count(t)')
            ->where('t.idutilClient IN(:tousLesClientsConcernes)')
            ->setParameter('tousLesClientsConcernes', array_values($clients))
        ;
        return $qb3->getQuery()->getSingleScalarResult();
    }

    /**
     * @return un seul chiffre
     * attention dans la bdd categorie = type
     */

    public function trouverNombreType($type){
        $qb4=$this->createQueryBuilder('t')
            ->select('Count(t)')
            ->where("t.idcategorie = :categorie")
            ->setParameter('categorie', $type)
        ;
        return $qb4->getQuery()->getSingleScalarResult();
    }

    /**
     * @return un seul chiffre


    public function trouverNombreAnnee($annee){
        $qb5=$this->createQueryBuilder('t')
            ->select('Count(t)')
            ->where("t.tpscreation LIKE :annee")
            ->setParameter('annee', '%'.$annee.'%')
        ;
        return $qb5->getQuery()->getSingleScalarResult();
    }
     * */

    /**
     * @return array de tous les tickets
     */

    public function trouverTousTicketsCorrespondant($criticite,$statut,$clients,$type){
        $qb6=$this->createQueryBuilder('t')
            ->select('t')
            ->where("t.idcategorie IN(:categorie)")
            ->andWhere('t.idutilClient IN(:tousLesClientsConcernes)')
            ->andWhere("t.idstatut IN(:statu)")
            ->andWhere("t.idcriticite IN(:crit)")
            ->setParameter('categorie', $type)
            ->setParameter('tousLesClientsConcernes', $clients)
            ->setParameter('statu', $statut)
            ->setParameter('crit', $criticite)
        ;
        return $qb6->getQuery()->getResult();
    }


}