<?php

namespace App\Entity;

use App\Repository\UserEleveRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UserEleveRepository::class)
 */
class UserEleve
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity=User::class, inversedBy="userEleve", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity=PageEleve::class, mappedBy="userEleve")
     */
    private $pages;

    public function __construct()
    {
        $this->pages = new ArrayCollection();
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

    /**
     * @return Collection|PageEleve[]
     */
    public function getPages(): Collection
    {
        return $this->pages;
    }

    public function addPage(PageEleve $page): self
    {
        if (!$this->pages->contains($page)) {
            $this->pages[] = $page;
            $page->setUserEleve($this);
        }

        return $this;
    }

    public function removePage(PageEleve $page): self
    {
        if ($this->pages->contains($page)) {
            $this->pages->removeElement($page);
            // set the owning side to null (unless already changed)
            if ($page->getUserEleve() === $this) {
                $page->setUserEleve(null);
            }
        }

        return $this;
    }

}
