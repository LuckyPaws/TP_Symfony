<?php

namespace App\Entity;

use App\Repository\NoteRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=NoteRepository::class)
 */
class Note
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float")
     */
    private $note;

    /**
     * @ORM\Column(type="float")
     */
    private $coefficient;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @ORM\ManyToOne(targetEntity=Matiere::class, inversedBy="notes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $evaluer;

    /**
     * @ORM\ManyToOne(targetEntity=Eleve::class, inversedBy="note_eleve")
     * @ORM\JoinColumn(nullable=false)
     */
    private $obtenir;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNote(): ?float
    {
        return $this->note;
    }

    public function setNote(float $note): self
    {
        $this->note = $note;

        return $this;
    }

    public function getCoefficient(): ?float
    {
        return $this->coefficient;
    }

    public function setCoefficient(float $coefficient): self
    {
        $this->coefficient = $coefficient;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getEvaluer(): ?Matiere
    {
        return $this->evaluer;
    }

    public function setEvaluer(?Matiere $evaluer): self
    {
        $this->evaluer = $evaluer;

        return $this;
    }

    public function getObtenir(): ?Eleve
    {
        return $this->obtenir;
    }

    public function setObtenir(?Eleve $obtenir): self
    {
        $this->obtenir = $obtenir;

        return $this;
    }
}
