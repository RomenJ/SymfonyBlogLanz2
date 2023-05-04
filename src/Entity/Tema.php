<?php

namespace App\Entity;

use App\Repository\TemaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use DateTime;
#[ORM\Entity(repositoryClass: TemaRepository::class)]
class Tema
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\ManyToOne(inversedBy: 'temas')]
    private ?User $creatortema = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $creadate = null;

    #[ORM\ManyToOne(inversedBy: 'temas')]
    private ?Foro $foro = null;

    #[ORM\Column(nullable: true)]
    private ?bool $oculto = null;

    #[ORM\OneToMany(mappedBy: 'tema', targetEntity: Comentario::class)]
    private Collection $comentarios;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $descrition = null;

    public function __construct()
    {
        $this->comentarios = new ArrayCollection();
        $this->creadate = new DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getCreatortema(): ?User
    {
        return $this->creatortema;
    }

    public function setCreatortema(?User $creatortema): self
    {
        $this->creatortema = $creatortema;

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

    public function getForo(): ?Foro
    {
        return $this->foro;
    }

    public function setForo(?Foro $foro): self
    {
        $this->foro = $foro;

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

    /**
     * @return Collection<int, Comentario>
     */
    public function getComentarios(): Collection
    {
        return $this->comentarios;
    }

    public function addComentario(Comentario $comentario): self
    {
        if (!$this->comentarios->contains($comentario)) {
            $this->comentarios->add($comentario);
            $comentario->setTema($this);
        }

        return $this;
    }

    public function removeComentario(Comentario $comentario): self
    {
        if ($this->comentarios->removeElement($comentario)) {
            // set the owning side to null (unless already changed)
            if ($comentario->getTema() === $this) {
                $comentario->setTema(null);
            }
        }

        return $this;
    }

    function __toString(){
        return $this->title;
    }

    public function getDescrition(): ?string
    {
        return $this->descrition;
    }

    public function setDescrition(?string $descrition): self
    {
        $this->descrition = $descrition;

        return $this;
    } 
}
