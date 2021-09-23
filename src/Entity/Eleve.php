<?php

namespace App\Entity;

use App\Repository\EleveRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EleveRepository::class)
 */
class Eleve
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenom;

    /**
     * @ORM\Column(type="date")
     */
    private $date_de_naissance;

    /**
     * @ORM\OneToMany(targetEntity=Note::class, mappedBy="obtenir")
     */
    private $note_eleve;

    /**
     * @ORM\ManyToOne(targetEntity=Classe::class, inversedBy="eleves")
     * @ORM\JoinColumn(nullable=false)
     */
    private $appartenir;

    public function __construct()
    {
        $this->note_eleve = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getDateDeNaissance(): ?\DateTimeInterface
    {
        return $this->date_de_naissance;
    }

    public function setDateDeNaissance(\DateTimeInterface $date_de_naissance): self
    {
        $this->date_de_naissance = $date_de_naissance;

        return $this;
    }

    /**
     * @return Collection|Note[]
     */
    public function getNoteEleve(): Collection
    {
        return $this->note_eleve;
    }

    public function addNoteEleve(Note $noteEleve): self
    {
        if (!$this->note_eleve->contains($noteEleve)) {
            $this->note_eleve[] = $noteEleve;
            $noteEleve->setObtenir($this);
        }

        return $this;
    }

    public function removeNoteEleve(Note $noteEleve): self
    {
        if ($this->note_eleve->removeElement($noteEleve)) {
            // set the owning side to null (unless already changed)
            if ($noteEleve->getObtenir() === $this) {
                $noteEleve->setObtenir(null);
            }
        }

        return $this;
    }

    public function getAppartenir(): ?Classe
    {
        return $this->appartenir;
    }

    public function setAppartenir(?Classe $appartenir): self
    {
        $this->appartenir = $appartenir;

        return $this;
    }
}
