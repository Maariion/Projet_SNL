<?php

namespace AppBundle\Entity;

/**
 * Typesysteme
 */
class Typesysteme
{
    /**
     * @var integer
     */
    private $nom;

    /**
     * @var integer
     */
    private $idts;


    /**
     * Set nom
     *
     * @param integer $nom
     *
     * @return Typesysteme
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return integer
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Get idts
     *
     * @return integer
     */
    public function getIdts()
    {
        return $this->idts;
    }
}

