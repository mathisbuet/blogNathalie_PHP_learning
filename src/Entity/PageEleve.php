<?php

namespace App\Entity;

use App\Entity\Page;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\PageEleveRepository;

/**
 * @ORM\Entity(repositoryClass=PageEleveRepository::class)
 */
class PageEleve extends Page
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

  

    /**
     * @ORM\ManyToOne(targetEntity=UserEleve::class, inversedBy="pages")
     * @ORM\JoinColumn(nullable=false)
     */
    private $userEleve;

    /**
     * @ORM\Column(type="smallint")
     */
    private $valide;

  

    public function getId(): ?int
    {
        return $this->id;
    }
   

    public function getUserEleve(): ?UserEleve
    {
        return $this->userEleve;
    }

    public function setUserEleve(?UserEleve $userEleve): self
    {
        $this->userEleve = $userEleve;

        return $this;
    }

    public function getValide(): ?int
    {
        return $this->valide;
    }

    public function setValide(int $valide): self
    {
        $this->valide = $valide;

        return $this;
    }

    

}
