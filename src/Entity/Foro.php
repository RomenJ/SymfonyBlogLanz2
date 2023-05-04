<?php

namespace App\Entity;

use App\Repository\ForoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use DateTime;
#[ORM\Entity(repositoryClass: ForoRepository::class)]
class Foro
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $creadate = null;

    public function __construct()
    {
        $this->creadate = new DateTime();
        $this->temas = new ArrayCollection();
    }

    #[ORM\ManyToOne(inversedBy: 'foros')]
    private ?User $creator = null;

    #[ORM\OneToMany(mappedBy: 'foro', targetEntity: Tema::class)]
    private Collection $temas;

    #[ORM\Column(nullable: true)]
    private ?bool $oculto = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $descripcion = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $foto = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

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

    public function getCreator(): ?User
    {
        return $this->creator;
    }

    public function setCreator(?User $creator): self
    {
        $this->creator = $creator;

        return $this;
    }

    /**
     * @return Collection<int, Tema>
     */
    public function getTemas(): Collection
    {
        return $this->temas;
    }

    public function addTema(Tema $tema): self
    {
        if (!$this->temas->contains($tema)) {
            $this->temas->add($tema);
            $tema->setForo($this);
        }

        return $this;
    }

    public function removeTema(Tema $tema): self
    {
        if ($this->temas->removeElement($tema)) {
            // set the owning side to null (unless already changed)
            if ($tema->getForo() === $this) {
                $tema->setForo(null);
            }
        }

        return $this;
    }

    function __toString(){
        return $this->name;
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

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(?string $descripcion): self
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    public function getFoto(): ?string
    {
        return $this->foto;
    }

    public function setFoto(?string $foto): self
    {
        $this->foto = $foto;

        return $this;
    }
}
