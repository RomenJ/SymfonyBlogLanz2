<?php

namespace App\Entity;

use App\Repository\ComentarioRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use DateTime;
#[ORM\Entity(repositoryClass: ComentarioRepository::class)]
class Comentario
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'comentarios')]
    private ?User $user = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $creadate = null;

    #[ORM\Column(nullable: true)]
    private ?bool $oculto = null;

    #[ORM\ManyToOne(inversedBy: 'comentarios')]
    private ?Tema $tema = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $texto = null;
    public function __construct()
    {
       
        $this->creadate = new DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getCreadate(): ?\DateTimeInterface
    {
        return $this->creadate;
    }

    public function setCreadate(?\DateTimeInterface $creadate): self
    {
        $this->creadate = $creadate;

        return $this;
    }

    public function isOculto(): ?bool
    {
        return $this->oculto;
    }

    public function setOculto(?bool $oculto): self
    {
        $this->oculto = $oculto;

        return $this;
    }

    public function getTema(): ?Tema
    {
        return $this->tema;
    }

    public function setTema(?Tema $tema): self
    {
        $this->tema = $tema;

        return $this;
    }

    public function getTexto(): ?string
    {
        return $this->texto;
    }

    public function setTexto(string $texto): self
    {
        $this->texto = $texto;

        return $this;
    }
    function __toString(){
        return $this->texto;
    }
}
