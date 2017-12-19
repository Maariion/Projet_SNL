<?php

namespace AppBundle\Entity;

/**
 * Piecejointe
 */
class Piecejointe
{
    /**
     * @var string
     */
    private $description;

    /**
     * @var integer
     */
    private $ticketIdt;

    /**
     * @var integer
     */
    private $idpj;


    /**
     * Set description
     *
     * @param string $description
     *
     * @return Piecejointe
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set ticketIdt
     *
     * @param integer $ticketIdt
     *
     * @return Piecejointe
     */
    public function setTicketIdt($ticketIdt)
    {
        $this->ticketIdt = $ticketIdt;

        return $this;
    }

    /**
     * Get ticketIdt
     *
     * @return integer
     */
    public function getTicketIdt()
    {
        return $this->ticketIdt;
    }

    /**
     * Get idpj
     *
     * @return integer
     */
    public function getIdpj()
    {
        return $this->idpj;
    }
    /**
     * @var integer
     */
    private $idtick;

    /**
     * @var string
     */
    private $objet;


    /**
     * Set idtick
     *
     * @param integer $idtick
     *
     * @return Piecejointe
     */
    public function setIdtick($idtick)
    {
        $this->idtick = $idtick;

        return $this;
    }

    /**
     * Get idtick
     *
     * @return integer
     */
    public function getIdtick()
    {
        return $this->idtick;
    }

    /**
     * Set objet
     *
     * @param string $objet
     *
     * @return Piecejointe
     */
    public function setObjet($objet)
    {
        $this->objet = $objet;

        return $this;
    }

    /**
     * Get objet
     *
     * @return string
     */
    public function getObjet()
    {
        return $this->objet;
    }
}
