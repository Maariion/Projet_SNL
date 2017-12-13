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
}

