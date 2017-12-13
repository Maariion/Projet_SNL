<?php

namespace AppBundle\Entity;

/**
 * Statut
 */
class Statut
{
    /**
     * @var string
     */
    private $definition;

    /**
     * @var integer
     */
    private $version;

    /**
     * @var integer
     */
    private $ids;


    /**
     * Set definition
     *
     * @param string $definition
     *
     * @return Statut
     */
    public function setDefinition($definition)
    {
        $this->definition = $definition;

        return $this;
    }

    /**
     * Get definition
     *
     * @return string
     */
    public function getDefinition()
    {
        return $this->definition;
    }

    /**
     * Set version
     *
     * @param integer $version
     *
     * @return Statut
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
     * Get ids
     *
     * @return integer
     */
    public function getIds()
    {
        return $this->ids;
    }
}

