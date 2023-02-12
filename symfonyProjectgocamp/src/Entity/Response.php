<?php

namespace App\Entity;

use App\Repository\ResponseRepository;
use Symfony\Component\Validator\Constraints as Assert;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ResponseRepository::class)
 */
class Response
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\NotBlank (message ="date reclamation is required")
     * 
     */
    private $description;

    /**
     * @ORM\OneToOne(targetEntity=Reclamation::class, cascade={"persist", "remove"})
     */
    private $Reclamation;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getReclamation(): ?Reclamation
    {
        return $this->Reclamation;
    }

    public function setReclamation(?Reclamation $Reclamation): self
    {
        $this->Reclamation = $Reclamation;

        return $this;
    }
}
