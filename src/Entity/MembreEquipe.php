<?php

namespace App\Entity;

use App\Repository\MembreEquipeRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MembreEquipeRepository::class)
 */
class MembreEquipe
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

/**
     *@ORM\OneToOne(targetEntity="Image",cascade={"persist","remove"})
     */
    private $image;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $civilite;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $metier;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $specialite;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description_metier;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $experience;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $formation;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $titre;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCivilite(): ?string
    {
        return $this->civilite;
    }

    public function setCivilite(string $civilite): self
    {
        $this->civilite = $civilite;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getMetier(): ?string
    {
        return $this->metier;
    }

    public function setMetier(string $metier): self
    {
        $this->metier = $metier;

        return $this;
    }

    public function getSpecialite(): ?string
    {
        return $this->specialite;
    }

    public function setSpecialite(string $specialite): self
    {
        $this->specialite = $specialite;

        return $this;
    }

    public function getDescriptionMetier(): ?string
    {
        return $this->description_metier;
    }

    public function setDescriptionMetier(string $description_metier): self
    {
        $this->description_metier = $description_metier;

        return $this;
    }

    public function getExperience(): ?string
    {
        return $this->experience;
    }

    public function setExperience(string $experience): self
    {
        $this->experience = $experience;

        return $this;
    }

    public function getFormation(): ?string
    {
        return $this->formation;
    }

    public function setFormation(string $formation): self
    {
        $this->formation = $formation;

        return $this;
    }

    /**
     * Get the value of image
     */ 
    public function getImage(): ?Image
    {
        return $this->image;
    }

    /**
     * Set the value of image
     *
     * @return  self
     */ 
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }
}
