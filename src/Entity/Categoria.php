<?php

namespace App\Entity;

use App\Repository\CategoriaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoriaRepository::class)]
class Categoria
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 50)]
    private $descricao_cat;

    #[ORM\OneToMany(mappedBy: 'categoria', targetEntity: Lancamento::class)]
    private $lancamentos;

    public function __construct()
    {
        $this->lancamentos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescricaoCat(): ?string
    {
        return $this->descricao_cat;
    }

    public function setDescricaoCat(string $descricao_cat): self
    {
        $this->descricao_cat = $descricao_cat;

        return $this;
    }

    /**
     * @return Collection<int, Lancamento>
     */
    public function getLancamentos(): Collection
    {
        return $this->lancamentos;
    }

    public function addLancamento(Lancamento $lancamento): self
    {
        if (!$this->lancamentos->contains($lancamento)) {
            $this->lancamentos[] = $lancamento;
            $lancamento->setCategoria($this);
        }

        return $this;
    }

    public function removeLancamento(Lancamento $lancamento): self
    {
        if ($this->lancamentos->removeElement($lancamento)) {
            // set the owning side to null (unless already changed)
            if ($lancamento->getCategoria() === $this) {
                $lancamento->setCategoria(null);
            }
        }

        return $this;
    }
}
