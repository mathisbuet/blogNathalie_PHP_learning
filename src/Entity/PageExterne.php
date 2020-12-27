<?php

namespace App\Entity;

use App\Entity\Page;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\PageExterneRepository;

/**
 * @ORM\Entity(repositoryClass=PageExterneRepository::class)
 */
class PageExterne extends Page
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $redirection;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRedirection(): ?string
    {
        return $this->redirection;
    }

    public function setRedirection(string $redirection): self
    {
        $this->redirection = $redirection;

        return $this;
    }
}
