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
     * @return array
     */
    public function findAllButSoftnlabs(){
        return $this->getEntityManager()->createQuery(
            "SELECT u FROM AppBundle:Utilisateur u WHERE u.organisation <> 1"
        )
            ->getResult();
    }
}