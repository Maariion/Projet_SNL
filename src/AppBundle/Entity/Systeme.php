<?php

namespace AppBundle\Entity;

/**
 * Systeme
 */
class Systeme
{
    /**
     * @var string
     */
    private $nom;

    /**
     * @var string
     */
    private $editeur;

    /**
     * @var integer
     */
    private $typesystemeIdts;

    /**
     * @var integer
     */
    private $ids;

    /**
     * @var integer
     */
    private $version;


    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return Systeme
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
     * Set editeur
     *
     * @param string $editeur
     *
     * @return Systeme
     */
    public function setEditeur($editeur)
    {
        $this->editeur = $editeur;

        return $this;
    }

    /**
     * Get editeur
     *
     * @return string
     */
    public function getEditeur()
    {
        return $this->editeur;
    }

    /**
     * Set typesystemeIdts
     *
     * @param integer $typesystemeIdts
     *
     * @return Systeme
     */
    public function setTypesystemeIdts($typesystemeIdts)
    {
        $this->typesystemeIdts = $typesystemeIdts;

        return $this;
    }

    /**
     * Get typesystemeIdts
     *
     * @return integer
     */
    public function getTypesystemeIdts()
    {
        return $this->typesystemeIdts;
    }

    /**
     * Set ids
     *
     * @param integer $ids
     *
     * @return Systeme
     */
    public function setIds($ids)
    {
        $this->ids = $ids;

        return $this;
    }

    /**
     * Get ids
     *
     * @return integer
     */
    public function getIds()
    {
        return $this->ids;
    }

    /**
     * Set version
     *
     * @param integer $version
     *
     * @return Systeme
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
}
