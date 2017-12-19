<?php

namespace AppBundle\Entity;

/**
 * Ticket
 */
class Ticket
{
    /**
     * @var integer
     */
    private $description;

    /**
     * @var \DateTime
     */
    private $tpsprisecompte;

    /**
     * @var \DateTime
     */
    private $tpsresolution;

    /**
     * @var string
     */
    private $utilisateurMailClient;

    /**
     * @var string
     */
    private $utilisateurMailAssigne;

    /**
     * @var integer
     */
    private $typeIdt;

    /**
     * @var integer
     */
    private $statutIds;

    /**
     * @var integer
     */
    private $criticiteIdc;

    /**
     * @var integer
     */
    private $systemeIds;

    /**
     * @var integer
     */
    private $systemeVersion;

    /**
     * @var integer
     */
    private $idt;


    /**
     * Set description
     *
     * @param integer $description
     *
     * @return Ticket
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return integer
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set tpsprisecompte
     *
     * @param \DateTime $tpsprisecompte
     *
     * @return Ticket
     */
    public function setTpsprisecompte($tpsprisecompte)
    {
        $this->tpsprisecompte = $tpsprisecompte;

        return $this;
    }

    /**
     * Get tpsprisecompte
     *
     * @return \DateTime
     */
    public function getTpsprisecompte()
    {
        return $this->tpsprisecompte;
    }

    /**
     * Set tpsresolution
     *
     * @param \DateTime $tpsresolution
     *
     * @return Ticket
     */
    public function setTpsresolution($tpsresolution)
    {
        $this->tpsresolution = $tpsresolution;

        return $this;
    }

    /**
     * Get tpsresolution
     *
     * @return \DateTime
     */
    public function getTpsresolution()
    {
        return $this->tpsresolution;
    }

    /**
     * Set utilisateurMailClient
     *
     * @param string $utilisateurMailClient
     *
     * @return Ticket
     */
    public function setUtilisateurMailClient($utilisateurMailClient)
    {
        $this->utilisateurMailClient = $utilisateurMailClient;

        return $this;
    }

    /**
     * Get utilisateurMailClient
     *
     * @return string
     */
    public function getUtilisateurMailClient()
    {
        return $this->utilisateurMailClient;
    }

    /**
     * Set utilisateurMailAssigne
     *
     * @param string $utilisateurMailAssigne
     *
     * @return Ticket
     */
    public function setUtilisateurMailAssigne($utilisateurMailAssigne)
    {
        $this->utilisateurMailAssigne = $utilisateurMailAssigne;

        return $this;
    }

    /**
     * Get utilisateurMailAssigne
     *
     * @return string
     */
    public function getUtilisateurMailAssigne()
    {
        return $this->utilisateurMailAssigne;
    }

    /**
     * Set typeIdt
     *
     * @param integer $typeIdt
     *
     * @return Ticket
     */
    public function setTypeIdt($typeIdt)
    {
        $this->typeIdt = $typeIdt;

        return $this;
    }

    /**
     * Get typeIdt
     *
     * @return integer
     */
    public function getTypeIdt()
    {
        return $this->typeIdt;
    }

    /**
     * Set statutIds
     *
     * @param integer $statutIds
     *
     * @return Ticket
     */
    public function setStatutIds($statutIds)
    {
        $this->statutIds = $statutIds;

        return $this;
    }

    /**
     * Get statutIds
     *
     * @return integer
     */
    public function getStatutIds()
    {
        return $this->statutIds;
    }

    /**
     * Set criticiteIdc
     *
     * @param integer $criticiteIdc
     *
     * @return Ticket
     */
    public function setCriticiteIdc($criticiteIdc)
    {
        $this->criticiteIdc = $criticiteIdc;

        return $this;
    }

    /**
     * Get criticiteIdc
     *
     * @return integer
     */
    public function getCriticiteIdc()
    {
        return $this->criticiteIdc;
    }

    /**
     * Set systemeIds
     *
     * @param integer $systemeIds
     *
     * @return Ticket
     */
    public function setSystemeIds($systemeIds)
    {
        $this->systemeIds = $systemeIds;

        return $this;
    }

    /**
     * Get systemeIds
     *
     * @return integer
     */
    public function getSystemeIds()
    {
        return $this->systemeIds;
    }

    /**
     * Set systemeVersion
     *
     * @param integer $systemeVersion
     *
     * @return Ticket
     */
    public function setSystemeVersion($systemeVersion)
    {
        $this->systemeVersion = $systemeVersion;

        return $this;
    }

    /**
     * Get systemeVersion
     *
     * @return integer
     */
    public function getSystemeVersion()
    {
        return $this->systemeVersion;
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
    /**
     * @var integer
     */
    private $utilisateurClient;

    /**
     * @var integer
     */
    private $utilisateurConsultant;

    /**
     * @var integer
     */
    private $idtick;


    /**
     * Set utilisateurClient
     *
     * @param integer $utilisateurClient
     *
     * @return Ticket
     */
    public function setUtilisateurClient($utilisateurClient)
    {
        $this->utilisateurClient = $utilisateurClient;

        return $this;
    }

    /**
     * Get utilisateurClient
     *
     * @return integer
     */
    public function getUtilisateurClient()
    {
        return $this->utilisateurClient;
    }

    /**
     * Set utilisateurConsultant
     *
     * @param integer $utilisateurConsultant
     *
     * @return Ticket
     */
    public function setUtilisateurConsultant($utilisateurConsultant)
    {
        $this->utilisateurConsultant = $utilisateurConsultant;

        return $this;
    }

    /**
     * Get utilisateurConsultant
     *
     * @return integer
     */
    public function getUtilisateurConsultant()
    {
        return $this->utilisateurConsultant;
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
     * @var string
     */
    private $titre;

    /**
     * @var integer
     */
    private $idtyp;

    /**
     * @var integer
     */
    private $idsta;

    /**
     * @var integer
     */
    private $idcrit;

    /**
     * @var integer
     */
    private $idutilClient;

    /**
     * @var integer
     */
    private $idutilConsultant;

    /**
     * @var integer
     */
    private $idsys;


    /**
     * Set titre
     *
     * @param string $titre
     *
     * @return Ticket
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get titre
     *
     * @return string
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set idtyp
     *
     * @param integer $idtyp
     *
     * @return Ticket
     */
    public function setIdtyp($idtyp)
    {
        $this->idtyp = $idtyp;

        return $this;
    }

    /**
     * Get idtyp
     *
     * @return integer
     */
    public function getIdtyp()
    {
        return $this->idtyp;
    }

    /**
     * Set idsta
     *
     * @param integer $idsta
     *
     * @return Ticket
     */
    public function setIdsta($idsta)
    {
        $this->idsta = $idsta;

        return $this;
    }

    /**
     * Get idsta
     *
     * @return integer
     */
    public function getIdsta()
    {
        return $this->idsta;
    }

    /**
     * Set idcrit
     *
     * @param integer $idcrit
     *
     * @return Ticket
     */
    public function setIdcrit($idcrit)
    {
        $this->idcrit = $idcrit;

        return $this;
    }

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
     * Set idutilClient
     *
     * @param integer $idutilClient
     *
     * @return Ticket
     */
    public function setIdutilClient($idutilClient)
    {
        $this->idutilClient = $idutilClient;

        return $this;
    }

    /**
     * Get idutilClient
     *
     * @return integer
     */
    public function getIdutilClient()
    {
        return $this->idutilClient;
    }

    /**
     * Set idutilConsultant
     *
     * @param integer $idutilConsultant
     *
     * @return Ticket
     */
    public function setIdutilConsultant($idutilConsultant)
    {
        $this->idutilConsultant = $idutilConsultant;

        return $this;
    }

    /**
     * Get idutilConsultant
     *
     * @return integer
     */
    public function getIdutilConsultant()
    {
        return $this->idutilConsultant;
    }

    /**
     * Set idsys
     *
     * @param integer $idsys
     *
     * @return Ticket
     */
    public function setIdsys($idsys)
    {
        $this->idsys = $idsys;

        return $this;
    }

    /**
     * Get idsys
     *
     * @return integer
     */
    public function getIdsys()
    {
        return $this->idsys;
    }
}
