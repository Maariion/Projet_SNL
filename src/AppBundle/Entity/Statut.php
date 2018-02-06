<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Statut
 *
 * @ORM\Table(name="statut")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\StatutRepository")
 */
class Statut
{
    /**
     * @var string
     *
     * @ORM\Column(name="Definition", type="string", length=250, nullable=false)
     */
    private $definition;

    /**
     * @var integer
     *
     * @ORM\Column(name="Version", type="integer", nullable=false)
     */
    private $version;

    /**
     * @var integer
     *
     * @ORM\Column(name="Id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @return string
     */
    public function getDefinition()
    {
        return $this->definition;
    }

    /**
     * @param string $definition
     */
    public function setDefinition($definition)
    {
        $this->definition = $definition;
    }


}

