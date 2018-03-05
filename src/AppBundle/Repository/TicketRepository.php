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
     * permet de savoir combien il y a de tickets correspondant à une criticité sélectionnée
     */

    public function trouverNombreCriticite($criticite,$tabid){
        $qb1=$this->createQueryBuilder('t')
            ->select('Count(t)')
            ->where("t.idcriticite = :crit")
            ->andWhere("t.id IN (:tabid)")
            ->setParameter('tabid', $tabid)
            ->setParameter('crit', $criticite)
        ;
        return $qb1->getQuery()->getSingleScalarResult();
    }

    /**
     * @return un seul chiffre
     * permet de savoir combien il y a de tickets correspondant à un statut sélectionné
     */

    public function trouverNombreStatut($statut,$tabid){
        $qb2=$this->createQueryBuilder('t')
            ->select('Count(t)')
            ->where("t.idstatut = :statu")
            ->andWhere("t.id IN (:tabid)")
            ->setParameter('tabid', $tabid)
            ->setParameter('statu', $statut)
        ;
        return $qb2->getQuery()->getSingleScalarResult();
    }

    /**
     * @return un seul chiffre
     * permet de savoir combien il y a de tickets correspondant à une liste d'utilisateur
     */

    public function trouverNombreOrganisation($clients,$tabid){
        $qb3=$this->createQueryBuilder('t')
            ->select('Count(t)')
            ->where('t.idutilClient IN(:tousLesClientsConcernes)')
            ->andWhere("t.id IN (:tabid)")
            ->setParameter('tabid', $tabid)
            ->setParameter('tousLesClientsConcernes', array_values($clients))
        ;
        return $qb3->getQuery()->getSingleScalarResult();
    }

    /**
     * @return un seul chiffre
     * attention dans la bdd categorie = type
     * permet de savoir combien il y a de tickets correspondant à une type sélectionné
     */

    public function trouverNombreType($type,$tabid){
        $qb4=$this->createQueryBuilder('t')
            ->select('Count(t)')
            ->where("t.idcategorie = :categorie")
            ->andWhere("t.id IN (:tabid)")
            ->setParameter('tabid', $tabid)
            ->setParameter('categorie', $type)
        ;
        return $qb4->getQuery()->getSingleScalarResult();
    }

    /**
     * @return un seul chiffre
     * permet de savoir combien il y a de tickets correspondant à un string (ici utilisé pour les années)
     */


    public function trouverNombreAnnee($annee,$tabid){
        $qb5=$this->createQueryBuilder('t')
            ->select('Count(t)')
            ->where("t.tpscreation LIKE :annee")
            ->andWhere("t.id IN (:tabid)")
            ->setParameter('tabid', $tabid)
            ->setParameter('annee', '%'.$annee.'%')
        ;
        return $qb5->getQuery()->getSingleScalarResult();
    }


    /**
     * @return array => liste des années
     * permet de récupérer les temps de création de chacun des ticket sans doublon
     */

    public function trouverLesAnnees() {
        $qb6=$this->createQueryBuilder('t')
            ->select('t.tpscreation')->distinct(true)
        ;
        return $qb6->getQuery()->getResult();
    }

    /**
     * @return array des id tickets correspondant
     * permet de récupérer les tickets correspondant à un string (ici utilisé pour les années)
     * * */


    public function trouverTicketsLieAnnee($annee){
        $qb5=$this->createQueryBuilder('t')
            ->select('t.id')
            ->where("t.tpscreation LIKE :annee")
            ->setParameter('annee', '%'.$annee.'%')
        ;
        return $qb5->getQuery()->getArrayResult();
    }

    /**
     * @return array de tous les id tickets
     * permet de récupérer l'id de tous les tickets
     * * */


    public function trouverTousTickets(){
        $qb9=$this->createQueryBuilder('t')
            ->select('t.id')
        ;
        return $qb9->getQuery()->getArrayResult();
    }


    /**
     * @return array de tous les tickets
     * permet de récupérer tous tickets correspondant à une liste de clients, une liste de types, une liste d'id de ticket, une liste de statuts
     * et une liste de criticités
     */

    public function trouverTousTicketsCorrespondant($criticite,$statut,$clients,$type,$ticketCorrespondantAnnnee){
        $qb7=$this->createQueryBuilder('t')
            ->select('t')
            ->where("t.idcategorie IN(:categorie)")
            ->andWhere('t.idutilClient IN(:tousLesClientsConcernes)')
            ->andWhere("t.idstatut IN(:statu)")
            ->andWhere("t.idcriticite IN(:crit)")
            ->andWhere("t.id IN (:ticketAnnee)")
            ->setParameter('categorie', $type)
            ->setParameter('tousLesClientsConcernes', $clients)
            ->setParameter('statu', $statut)
            ->setParameter('crit', $criticite)
            ->setParameter('ticketAnnee', $ticketCorrespondantAnnnee)
        ;
        return $qb7->getQuery()->getResult();
    }


}