<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\ComentarioRepository")
 */
class Comentario
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $conteudo;

    /**
     * @ORM\Column(type="datetime")
     */
    private $publicadoEm;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Usuario", inversedBy="comentarios")
     * @ORM\JoinColumn(nullable=false)
     */
    private $autor;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getConteudo(): ?string
    {
        return $this->$conteudo;
    }

    public function setConteudo(string $conteudo): self
    {
        $this->$conteudo = $conteudo;

        return $this;
    }

    public function getPublicadoEm(): ?\DateTimeInterface
    {
        return $this->publicadoEm;
    }

    public function setPublicadoEm(\DateTimeInterface $publicadoEm): self
    {
        $this->publicadoEm = $publicadoEm;

        return $this;
    }

    public function getAutor(): ?Usuario
    {
        return $this->autor;
    }

    public function setAutor(?Usuario $autor): self
    {
        $this->autor = $autor;

        return $this;
    }
}
