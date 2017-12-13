<?php

namespace AppBundle\Entity;

/**
 * Utilisateur
 */
class Utilisateur
{
    /**
     * @var string
     */
    private $nom;

    /**
     * @var string
     */
    private $prenom;

    /**
     * @var string
     */
    private $role;

    /**
     * @var boolean
     */
    private $actif;

    /**
     * @var string
     */
    private $motpasse;

    /**
     * @var integer
     */
    private $organisationOid;

    /**
     * @var string
     */
    private $mail;


    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return Utilisateur
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
     * Set prenom
     *
     * @param string $prenom
     *
     * @return Utilisateur
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set role
     *
     * @param string $role
     *
     * @return Utilisateur
     */
    public function setRole($role)
    {
        $this->role = $role;

        return $this;
    }

    /**
     * Get role
     *
     * @return string
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Set actif
     *
     * @param boolean $actif
     *
     * @return Utilisateur
     */
    public function setActif($actif)
    {
        $this->actif = $actif;

        return $this;
    }

    /**
     * Get actif
     *
     * @return boolean
     */
    public function getActif()
    {
        return $this->actif;
    }

    /**
     * Set motpasse
     *
     * @param string $motpasse
     *
     * @return Utilisateur
     */
    public function setMotpasse($motpasse)
    {
        $this->motpasse = $motpasse;

        return $this;
    }

    /**
     * Get motpasse
     *
     * @return string
     */
    public function getMotpasse()
    {
        return $this->motpasse;
    }

    /**
     * Set organisationOid
     *
     * @param integer $organisationOid
     *
     * @return Utilisateur
     */
    public function setOrganisationOid($organisationOid)
    {
        $this->organisationOid = $organisationOid;

        return $this;
    }

    /**
     * Get organisationOid
     *
     * @return integer
     */
    public function getOrganisationOid()
    {
        return $this->organisationOid;
    }

    /**
     * Get mail
     *
     * @return string
     */
    public function getMail()
    {
        return $this->mail;
    }
}

