<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Piecejointe
 *
 * @ORM\Table(name="piecejointe")
 * @ORM\Entity
 */
class Piecejointe
{
    /**
     * @var Integer
     * @ORM\Column(nullable=true)
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Ticket")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ticket", referencedColumnName="Id")
     * })
     *
     */
    private $idticket;

    /**
     * @var string
     *
     * @ORM\Column(name="Objet", type="blob", length=65535, nullable=false)
     */
    private $objet;

    /**
     * @var integer
     *
     * @ORM\Column(name="Id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @return int
     */
    public function getIdticket()
    {
        return $this->idticket;
    }

    /**
     * @param int $idticket
     */
    public function setIdticket($idticket)
    {
        $this->idticket = $idticket;
    }

    /**
     * @return string
     */
    public function getObjet()
    {
        return $this->objet;
    }

    /**
     * @param string $objet
     */
    public function setObjet($objet)
    {
        $this->objet = $objet;
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

