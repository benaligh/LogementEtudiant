<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Location
 *
 * @ORM\Table(name="location")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\LocationRepository")
 */
class Location
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     * @Assert\NotBlank(message="champs obligatoire")
     * @ORM\Column(name="titre", type="string", length=150)
     */
    private $titre;

    /**
     * @var string
     * @Assert\NotBlank(message="champs obligatoire")
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

    /**
     * @var string
     * @Assert\NotBlank(message="champs obligatoire")
     * @ORM\Column(name="type", type="string", length=50)
     */
    private $type;

    /**
     * @var string
     * @Assert\NotBlank(message="champs obligatoire")
     * @ORM\Column(name="equipement", type="string", length=50)
     */
    private $equipement;

    /**
     * @var string
     * @Assert\NotBlank(message="champs obligatoire")
     * @ORM\Column(name="etat", type="string", length=50)
     */
    private $etat;

    /**
     * @var string
     * @Assert\NotBlank(message="champs obligatoire")
     * @ORM\Column(name="piece", type="string")
     */
    private $piece;

    /**
     * @var int
     * @Assert\NotBlank(message="champs obligatoire")
     * @ORM\Column(name="surface", type="integer")
     */
    private $surface;

    /**
     * @var \DateTime
     * @Assert\NotBlank(message="champs obligatoire")
     * @ORM\Column(name="date_disp", type="date")
     */
    private $dateDisp;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_publication", type="date")
     */
    private $datePublication;

    /**
     * @var string
     * @Assert\NotBlank(message="champs obligatoire")
     * @ORM\Column(name="adresse", type="string", length=200)
     */
    private $adresse;

    /**
     * @var string
     * @Assert\NotBlank(message="champs obligatoire")
     * @ORM\Column(name="region", type="string", length=30)
     */
    private $region;

    /**
     * @var int
     * @Assert\NotBlank(message="champs obligatoire")
     * @ORM\Column(name="prix", type="integer")
     */
    private $prix;

    /**
     * @var string
     * @Assert\NotBlank(message="champs obligatoire")
     * @ORM\Column(name="photo", type="string", length=255, nullable=true)
     */
    private $photo;


    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User"))
     */
    private $user;

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set titre
     *
     * @param string $titre
     *
     * @return Location
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
     * Set description
     *
     * @param string $description
     *
     * @return Location
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set type
     *
     * @param string $type
     *
     * @return Location
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set equipement
     *
     * @param string $equipement
     *
     * @return Location
     */
    public function setEquipement($equipement)
    {
        $this->equipement = $equipement;

        return $this;
    }

    /**
     * Get equipement
     *
     * @return string
     */
    public function getEquipement()
    {
        return $this->equipement;
    }

    /**
     * Set etat
     *
     * @param string $etat
     *
     * @return Location
     */
    public function setEtat($etat)
    {
        $this->etat = $etat;

        return $this;
    }

    /**
     * Get etat
     *
     * @return string
     */
    public function getEtat()
    {
        return $this->etat;
    }

    /**
     * Set piece
     *
     * @param integer $piece
     *
     * @return Location
     */
    public function setPiece($piece)
    {
        $this->piece = $piece;

        return $this;
    }

    /**
     * Get piece
     *
     * @return int
     */
    public function getPiece()
    {
        return $this->piece;
    }

    /**
     * Set surface
     *
     * @param float $surface
     *
     * @return Location
     */
    public function setSurface($surface)
    {
        $this->surface = $surface;

        return $this;
    }

    /**
     * Get surface
     *
     * @return float
     */
    public function getSurface()
    {
        return $this->surface;
    }

    /**
     * Set dateDisp
     *
     * @param \DateTime $dateDisp
     *
     * @return Location
     */
    public function setDateDisp($dateDisp)
    {
        $this->dateDisp = $dateDisp;

        return $this;
    }


    /**
     * Get dateDisp
     *
     * @return \DateTime
     */
    public function getDateDisp()
    {
        return $this->dateDisp;
    }

    /**
     * Set datePublication
     *
     * @param \DateTime $datePublication
     *
     * @return Location
     */
    public function setDatePublication($datePublication)
    {
        $this->datePublication = $datePublication;

        return $this;
    }

    /**
     * Get datePublication
     *
     * @return \DateTime
     */
    public function getDatePublication()
    {
        return $this->datePublication;
    }

    /**
     * Set adresse
     *
     * @param string $adresse
     *
     * @return Location
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

    /**
     * Set region
     *
     * @param string $region
     *
     * @return Location
     */
    public function setRegion($region)
    {
        $this->region = $region;

        return $this;
    }

    /**
     * Get region
     *
     * @return string
     */
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * Set prix
     *
     * @param integer $prix
     *
     * @return Location
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;

        return $this;
    }

    /**
     * Get prix
     *
     * @return int
     */
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * Set photo
     *
     * @param string $photo
     *
     * @return Location
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * Get photo
     *
     * @return string
     */
    public function getPhoto()
    {
        return $this->photo;
    }






    public function __construct()
    {
        $this->date_publication = new \DateTime('now');
    }


}

