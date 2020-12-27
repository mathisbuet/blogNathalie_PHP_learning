<?php

namespace App\Entity;

use DateTimeInterface;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\MappedSuperclass;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;
/** 
 * 
 * @Vich\Uploadable
 * @MappedSuperclass 
 * */
class Page
{

    /**
     * @Column(type="string", length=255)
     * @Assert\Length(max=22, maxMessage="Le titre est trop long ! Si tu veux un titre aussi long, demande à Mathis de venir t'aider !")
     * @Assert\NotNull
     */
    protected $title;

    /**
     * @Column(type="datetime")
     */
    protected $createdAt;

    /**
     * @Vich\UploadableField(mapping="pages_image", fileNameProperty="imageName")
     * 
     * @Assert\Image(
     *     minWidth = 500,
     *     minHeight = 500,
     *     allowLandscape = false,
     *     allowPortrait = false
     * )
    
     * 
     * @var File|null
     */
    protected $imageFile;

    /**
     * @Column(type="string")
     * 
     * @var string|null
     */
    protected $imageName;
    

    /**
     * @Column(type="datetime")
     * 
     * @var \DateTimeInterface|null
     */
    protected $updatedAt;   
      

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

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     *
     * @param File|UploadedFile|null $imageFile
     */
    public function setImageFile(?File $imageFile = null)
    {
        $this->imageFile = $imageFile;

        if (null !== $imageFile) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function setImageName(?string $imageName): void
    {
        $this->imageName = $imageName;
   
   
    }

    public function getImageName(): ?string
    {
        return $this->imageName;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): void
    {
        $this->updatedAt = $updatedAt;

    }
    

    
}
