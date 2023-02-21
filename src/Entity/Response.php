<?php

namespace App\Entity;

use App\Repository\ResponseRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
#[ORM\Entity(repositoryClass: ResponseRepository::class)]
class Response
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message:"Description is required")]
    private ?string $description = null;

    #[ORM\ManyToOne(targetEntity: Reclamation::class, inversedBy: 'responses')]
    private $Reclamation;



    public function getId(): ?int
    {
        return $this->id;
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
