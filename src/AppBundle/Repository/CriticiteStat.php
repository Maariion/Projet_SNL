<?php
/**
 * Created by PhpStorm.
 * User: Utilisateur
 * Date: 01/02/2018
 * Time: 15:19
 */

namespace AppBundle\Repository;


use Doctrine\ORM\EntityRepository;

class CriticiteStat extends EntityRepository
{
    /**
     * @return array
     */

    public function findCriticite(){
        return $this->getEntityManager()->createQuery(
            "Select COUNT(t.Id),c.Chaine FROM AppBundle:Ticket t JOIN AppBundle:Criticite c ON (c.Id=t.criticite) WHERE c.chaine= 'Basse' GROUP BY c.Chaine"
        )
            ->getArrayResult();
    }
}