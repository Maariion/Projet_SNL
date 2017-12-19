<?php

namespace AppBundle\Entity;

/**
 * Criticite
 */
class Criticite
{
    /**
     * @var \DateTime
     */
    private $tpsreponse;

    /**
     * @var integer
     */
    private $version;

    /**
     * @var integer
     */
    private $idc;


    /**
     * Set tpsreponse
     *
     * @param \DateTime $tpsreponse
     *
     * @return Criticite
     */
    public function setTpsreponse($tpsreponse)
    {
        $this->tpsreponse = $tpsreponse;

        return $this;
    }

    /**
     * Get tpsreponse
     *
     * @return \DateTime
     */
    public function getTpsreponse()
    {
        return $this->tpsreponse;
    }

    /**
     * Set version
     *
     * @param integer $version
     *
     * @return Criticite
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
     * Get idc
     *
     * @return integer
     */
    public function getIdc()
    {
        return $this->idc;
    }
    /**
     * @var integer
     */
    private $idcrit;


    /**
     * Get idcrit
     *
     * @return integer
     */
    public function getIdcrit()
    {
        return $this->idcrit;
    }
    /**
     * @var string
     */
    private $chaine;


    /**
     * Set chaine
     *
     * @param string $chaine
     *
     * @return Criticite
     */
    public function setChaine($chaine)
    {
        $this->chaine = $chaine;

        return $this;
    }

    /**
     * Get chaine
     *
     * @return string
     */
    public function getChaine()
    {
        return $this->chaine;
    }
}
