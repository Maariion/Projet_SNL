<?php
/**
 * Created by PhpStorm.
 * User: Utilisateur
 * Date: 01/02/2018
 * Time: 15:19
 */

namespace AppBundle\Repository;


use Doctrine\ORM\EntityRepository;

class UtilisateurRepository extends EntityRepository
{
    /**
     * @return  array
     */
    public function findConsultantByWorkAmount(){
        return $this->getEntityManager()->createQuery(
            "SELECT u FROM (SELECT u, COUNT(*) AS NB_TICKETS FROM AppBundle:Utilisateur JOIN AppBundle:Ticket t ON t.consultant = u.id
                  WHERE t.statut = 2 GROUP BY t.consultant ORDER BY NB_TICKETS)"
        )
            ->getResult();
    }


    /**
     * @return array
     */
    public function findAllButSoftnlabs(){
        return $this->getEntityManager()->createQuery(
            "SELECT u FROM AppBundle:Utilisateur u WHERE u.organisation <> 1"
        )
            ->getResult();
    }

    /**
     * @return array
     *
     * Retourne tous les utilisateurs sauf le 'Aucun consultant'
     */
    public function findAllButNoConsultant(){
        return $this->getEntityManager()->createQuery(
            "SELECT u FROM AppBundle:Utilisateur u WHERE u.id != '-1'"
        )
            ->getResult();
    }

    /**
     * @return array
     * permet de récupérer tous les utilisateurs liés à une organisation
     */

    public function trouverUtilisateurLieOrganisation($organisation){
        $qb3=$this->createQueryBuilder('u')
            ->select('u.id')
            ->where('u.organisation =:orga')
            ->setParameter('orga', $organisation)
        ;
        return $qb3->getQuery()->getArrayResult();
    }

    /**
     * @return array
     * permet de récupérer tous les utilisateurs liés à une liste d'organisations
     */

    public function trouverTousUtilisateursLieOrganisation($organisation){
        $qb4=$this->createQueryBuilder('u')
            ->select('u.id')
            ->where('u.organisation IN(:orga)')
            ->setParameter('orga', $organisation)
        ;
        return $qb4->getQuery()->getArrayResult();
    }

}