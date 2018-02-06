<?php

namespace AppBundle\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * Ticket
 *
 * @ORM\Table(name="ticket")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TicketRepository")
 */
class Ticket
{
    /**
     * @var string
     *
     * @ORM\Column(name="Titre", type="string", length=150, nullable=false)
     */
    private $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="Description", type="text", length=65535, nullable=false)
     */
    private $description;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="TpsPriseCompte", type="datetime", nullable=true)
     */
    private $tpsprisecompte;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="TpsResolution", type="datetime", nullable=true)
     */
    private $tpsresolution;

    /**
     * @var Integer
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Categorie")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="categorie", referencedColumnName="Id")
     * })
     *
     */
    private $idcategorie;

    /**
     * @var Integer
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Statut")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="statut", referencedColumnName="Id")
     * })
     *
     */
    private $idstatut;

    /**
     * @var Integer
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Criticite")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="criticite", referencedColumnName="Id")
     * })
     */
    private $idcriticite;

    /**
     * @var Integer
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Utilisateur",cascade={"persist"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="client", referencedColumnName="Id")
     * })
     *
     */
    private $idutilClient;

    /**
     * @var Integer
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Utilisateur", cascade={"persist"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="consultant", referencedColumnName="Id")
     * })
     *
     */
    private $idutilConsultant;

    /**
     * @var Integer
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Systeme")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="systeme", referencedColumnName="Id")
     * })
     *
     */
    private $idsysteme;

    /**
     * @var integer
     *
     * @ORM\Column(name="Id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;


    /**
     * @var datetime
     *
     * @ORM\Column(name="tpscreation", type="datetime")
     */
    private $tpscreation;

    /**
     * @return datetime
     */
    public function getTpscreation()
    {
        return $this->tpscreation;
    }

    /**
     * @param datetime $tpscreation
     */
    public function setTpscreation($tpscreation)
    {
        $this->tpscreation = $tpscreation;
    }


    /**
     * @return string
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * @param string $titre
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return \DateTime
     */
    public function getTpsprisecompte()
    {
        return $this->tpsprisecompte;
    }

    /**
     * @param \DateTime $tpsprisecompte
     */
    public function setTpsprisecompte($tpsprisecompte)
    {
        $this->tpsprisecompte = $tpsprisecompte;
    }

    /**
     * @return \DateTime
     */
    public function getTpsresolution()
    {
        return $this->tpsresolution;
    }

    /**
     * @param \DateTime $tpsresolution
     */
    public function setTpsresolution($tpsresolution)
    {
        $this->tpsresolution = $tpsresolution;
    }

    /**
     * @return int
     */
    public function getIdcategorie()
    {
        return $this->idcategorie;
    }

    /**
     * @param int $idcategorie
     */
    public function setIdcategorie($idcategorie)
    {
        $this->idcategorie = $idcategorie;
    }

    /**
     * @return int
     */
    public function getIdstatut()
    {
        return $this->idstatut;
    }

    /**
     * @param int $idstatut
     */
    public function setIdstatut($idstatut)
    {
        $this->idstatut = $idstatut;
    }

    /**
     * @return int
     */
    public function getIdcriticite()
    {
        return $this->idcriticite;
    }

    /**
     * @param int $idcriticite
     */
    public function setIdcriticite($idcriticite)
    {
        $this->idcriticite = $idcriticite;
    }

    /**
     * @return int
     */
    public function getIdutilClient()
    {
        return $this->idutilClient;
    }

    /**
     * @param int $idutilClient
     */
    public function setIdutilClient($idutilClient)
    {
        $this->idutilClient = $idutilClient;
    }

    /**
     * @return int
     */
    public function getIdutilConsultant()
    {
        return $this->idutilConsultant;
    }

    /**
     * @param int $idutilConsultant
     */
    public function setIdutilConsultant($idutilConsultant)
    {
        $this->idutilConsultant = $idutilConsultant;
    }

    /**
     * @return int
     */
    public function getIdsysteme()
    {
        return $this->idsysteme;
    }

    /**
     * @param int $idsysteme
     */
    public function setIdsysteme($idsysteme)
    {
        $this->idsysteme = $idsysteme;
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

