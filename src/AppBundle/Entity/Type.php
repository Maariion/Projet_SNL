<?php

namespace AppBundle\Entity;

/**
 * Type
 */
class Type
{
    /**
     * @var string
     */
    private $nom;

    /**
     * @var integer
     */
    private $version;

    /**
     * @var integer
     */
    private $idt;


    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return Type
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set version
     *
     * @param integer $version
     *
     * @return Type
     */
    public function setVersion($version)
    {
        $this->version = $version;

        return $this;
    }

    /**
     * Get version
     *
     * @return integer
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * Get idt
     *
     * @return integer
     */
    public function getIdt()
    {
        return $this->idt;
    }
}
