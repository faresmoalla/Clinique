<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use App\Repository\ReclamationRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ReclamationRepository::class)
 */
class Reclamation
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string A "Y-m-d" formatted value
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank (message ="date reclamation is required")
     * @Assert\Date()
     */
    private $date_reclamation;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $type_reclamation;
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $etat;


    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Description is required")
     */
    private $description;



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateReclamation(): ?string
    {
        return $this->date_reclamation;
    }

    public function setDateReclamation(string $date_reclamation): self
    {
        $this->date_reclamation = $date_reclamation;

        return $this;
    }

    public function getTypeReclamation(): ?string
    {
        return $this->type_reclamation;
    }

    public function setTypeReclamation(string $type_reclamation): self
    {
        $this->type_reclamation = $type_reclamation;

        return $this;
    }




    public function getEtat(): ?string
    {
        return $this->etat;
    }

    public function setEtat(string $etat): self
    {
        $this->etat = $etat;

        return $this;
    }


    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }


}
