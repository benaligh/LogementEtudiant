<?php
// src/AppBundle/Entity/User.php

namespace AppBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;


    /**
     * @var string
     * @Assert\NotBlank(message="champs obligatoire")
     * @Assert\Type(type="string",
     *             message="nom ne doit pas contient que des caractéres ")
     * @Assert\Length(min="5",max="10",
     *     minMessage="votre nom doit dépasser 5 caractére",
     *     maxMessage="votre nom ne doit pas dépasser 10 caractére")
     * @ORM\Column(name="nom", type="string", length=50, nullable=true)
     */
    private $nom;


    /**
     * @var string
     * @Assert\NotBlank(message="champs obligatoire")
     * @Assert\Type(type="string",
     *             message="prénom ne doit pas contient que des caractéres ")
     * @Assert\Length(min="5",max="10",
     *     minMessage="votre prénom doit dépasser 5 caractére",
     *     maxMessage="votre prénom ne doit pas dépasser 10 caractére")
     * @ORM\Column(name="prenom", type="string", length=50, nullable=true)
     */
    private $prenom;


    /**
     * @var int
     * @Assert\NotBlank(message="champs obligatoire")
     * @Assert\Range(min="10000000",max="99999999",
     *               minMessage="mobile number invalid",
     *               maxMessage="mobile number invalid" )
     * @ORM\Column(name="telephone", type="integer", nullable=true)
     */
    private $telephone;

    /**
     * @var string
      * @Assert\NotBlank(message="champs obligatoire")
     * @Assert\Choice({"M","Mme","Mlle"})
     * @ORM\Column(name="civilité", type="string", length=30, nullable=true)
     */
    private $civilite;


    /**
     * @var string
     *
     * @ORM\Column(name="ecole", type="string", length=100, nullable=true)
     */
    private $ecole;


    /**
     * @var string
     * @ORM\Column(name="nom_groupe", type="string", length=50, nullable=true)
     */
    private $nom_groupe;


    /**
     * @var string
     * @ORM\Column(name="adresse", type="string", length=200, nullable=true)
     */
    private $adresse;




    public function __construct()
    {
        parent::__construct();
        // your own logic
    }


    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return User
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
     * @return User
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
     * Set telephone
     *
     * @param integer $telephone
     *
     * @return User
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;

        return $this;
    }

    /**
     * Get telephone
     *
     * @return integer
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * Set civilite
     *
     * @param string $civilite
     *
     * @return User
     */
    public function setCivilite($civilite)
    {
        $this->civilite = $civilite;

        return $this;
    }

    /**
     * Get civilite
     *
     * @return string
     */
    public function getCivilite()
    {
        return $this->civilite;
    }

    /**
     * Set ecole
     *
     * @param string $ecole
     *
     * @return User
     */
    public function setEcole($ecole)
    {
        $this->ecole = $ecole;

        return $this;
    }

    /**
     * Get ecole
     *
     * @return string
     */
    public function getEcole()
    {
        return $this->ecole;
    }

    /**
     * Set nomGroupe
     *
     * @param string $nomGroupe
     *
     * @return User
     */
    public function setNomGroupe($nomGroupe)
    {
        $this->nom_groupe = $nomGroupe;

        return $this;
    }

    /**
     * Get nomGroupe
     *
     * @return string
     */
    public function getNomGroupe()
    {
        return $this->nom_groupe;
    }

    /**
     * Set adresse
     *
     * @param string $adresse
     *
     * @return User
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get adresse
     *
     * @return string
     */
    public function getAdresse()
    {
        return $this->adresse;
    }


}
