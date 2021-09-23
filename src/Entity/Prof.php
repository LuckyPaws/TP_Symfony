<?php

namespace App\Entity;

use App\Repository\ProfRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProfRepository::class)
 */
class Prof
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
     * @ORM\OneToMany(targetEntity=Classe::class, mappedBy="classes")
     */
    private $prof_principal;

    /**
     * @ORM\OneToMany(targetEntity=Matiere::class, mappedBy="prof")
     */
    private $Enseigner;

    public function __construct()
    {
        $this->prof_principal = new ArrayCollection();
        $this->Enseigner = new ArrayCollection();
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
     * @return Collection|Classe[]
     */
    public function getProfPrincipal(): Collection
    {
        return $this->prof_principal;
    }

    public function addProfPrincipal(Classe $profPrincipal): self
    {
        if (!$this->prof_principal->contains($profPrincipal)) {
            $this->prof_principal[] = $profPrincipal;
            $profPrincipal->setClasses($this);
        }

        return $this;
    }

    public function removeProfPrincipal(Classe $profPrincipal): self
    {
        if ($this->prof_principal->removeElement($profPrincipal)) {
            // set the owning side to null (unless already changed)
            if ($profPrincipal->getClasses() === $this) {
                $profPrincipal->setClasses(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Matiere[]
     */
    public function getEnseigner(): Collection
    {
        return $this->Enseigner;
    }

    public function addEnseigner(Matiere $enseigner): self
    {
        if (!$this->Enseigner->contains($enseigner)) {
            $this->Enseigner[] = $enseigner;
            $enseigner->setProf($this);
        }

        return $this;
    }

    public function removeEnseigner(Matiere $enseigner): self
    {
        if ($this->Enseigner->removeElement($enseigner)) {
            // set the owning side to null (unless already changed)
            if ($enseigner->getProf() === $this) {
                $enseigner->setProf(null);
            }
        }

        return $this;
    }
}
