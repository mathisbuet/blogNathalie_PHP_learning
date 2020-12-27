<?php

namespace App\Entity;

use App\Entity\Page;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\PageNathalieRepository;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass=PageNathalieRepository::class)
 * @Vich\Uploadable
 */
class PageNathalie extends Page
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Url(message="Vous devez insérer une URL")
     */
    private $lienAzza;

    

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

    public function getLienAzza(): ?string
    {
        return $this->lienAzza;
    }

    public function setLienAzza(?string $lienAzza): self
    {
        $this->lienAzza = $lienAzza;

        return $this;
    }

    
}
