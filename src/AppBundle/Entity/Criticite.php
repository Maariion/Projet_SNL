<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Criticite
 *
 * @ORM\Table(name="criticite")
 * @ORM\Entity
 */
class Criticite
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="TpsReponse", type="datetime", nullable=true)
     */
    private $tpsreponse;

    /**
     * @var string
     *
     * @ORM\Column(name="Chaine", type="string", length=50, nullable=false)
     */
    private $chaine;

    /**
     * @var integer
     *
     * @ORM\Column(name="Id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @return \DateTime
     */
    public function getTpsreponse()
    {
        return $this->tpsreponse;
    }

    /**
     * @param \DateTime $tpsreponse
     */
    public function setTpsreponse($tpsreponse)
    {
        $this->tpsreponse = $tpsreponse;
    }

    /**
     * @return string
     */
    public function getChaine()
    {
        return $this->chaine;
    }

    /**
     * @param string $chaine
     */
    public function setChaine($chaine)
    {
        $this->chaine = $chaine;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }


}

