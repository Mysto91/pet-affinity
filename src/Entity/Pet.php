<?php

namespace App\Entity;

use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;
use App\Validator as AssertCustom;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PetRepository")
 * @Vich\Uploadable()
  * @ApiResource(
 *      normalizationContext={
 *          "groups"={
 *              "pet:read"
 *          }
 *      },
 * 
 *      denormalizationContext={
 *          "groups"={
 *              "pet:write"
 *          }
 *      },
 * 
 *      collectionOperations={
 *      "get"={},
 *      "post"={},
 *      },
 * 
 *      itemOperations={
 *      "get"={},
 *      "put"={},
 *      "delete"={},
 *      "patch"={},
 *      }
 * )
 */
class Pet
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"pet:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(
     *          min="3",
     *          minMessage="Provide a name with at least three character",
     *          max="50",
     *          maxMessage="Field too long"
     * )
     * @Assert\NotBlank(message="Name is mandatory")
     * @Groups({"pet:read", "pet:write"})
     */
    private $Name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"pet:read", "pet:write"})
     */
    private $Description;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"pet:read", "pet:write"})
     * @Assert\NotBlank(message="Gender is mandatory")
     * @AssertCustom\Gender()
     */
    private $gender;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"pet:read", "pet:write"})
     * @Assert\NotBlank(message="Color is mandatory")
     */
    private $color;

    /**
     * @ORM\Column(type="float", nullable=true)
     * @Assert\Range(min="1", max="1000")
     * @Groups({"pet:read", "pet:write"})
     */
    private $size;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Assert\Range(min="0", max="50")
     * @Groups({"pet:read", "pet:write"})
     */
    private $age;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\TypePet", inversedBy="pets")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"pet:read", "pet:write"})
     * @AssertCustom\TypePet()
     */
    private $typePet;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @Groups("pet:read")
     */
    private $createdAt;

    /**
     * @var string|null
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups("pet:read")
     */
    private $fileName;

    /**
     * @var File|null
     * @Assert\Image(
     *      mimeTypes="image/jpeg"
     * )
     * @Vich\UploadableField(mapping="pet_image", fileNameProperty="fileName")
     */
    private $imageFile;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @Groups("pet:read")
     */
    private $updatedAt;

    /**
     * @Groups({"pet:read", "pet:write"})
     */
    private $type;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): self
    {
        $this->Name = $Name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(?string $Description): self
    {
        $this->Description = $Description;

        return $this;
    }

    public function getGender(): ?string
    {
        return $this->gender;
    }

    public function setGender(string $gender): self
    {
        $this->gender = $gender;

        return $this;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(string $color): self
    {
        $this->color = $color;

        return $this;
    }

    public function getSize(): ?float
    {
        return $this->size;
    }

    public function setSize(float $size): self
    {
        $this->size = $size;

        return $this;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(?int $age): self
    {
        $this->age = $age;

        return $this;
    }

    public function getTypePet(): ?TypePet
    {
        return $this->typePet;
    }

    public function setTypePet(?TypePet $typePet): self
    {
        $this->typePet = $typePet;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function exist()
    {
        return $this->getId() != null;
    }

    /**
     * Get the value of fileName
     *
     * @return  string|null
     */ 
    public function getFileName()
    {
        return $this->fileName;
    }

    /**
     * Set the value of fileName
     *
     * @param  string|null  $fileName
     *
     * @return  self
     */ 
    public function setFileName($fileName)
    {
        $this->fileName = $fileName;

        return $this;
    }

    /**
     * Get the value of imageFile
     *
     * @return  File|null
     */ 
    public function getImageFile()
    {
        return $this->imageFile;
    }

    /**
     * Set the value of imageFile
     *
     * @param  File|null  $imageFile
     *
     * @return  self
     */ 
    public function setImageFile($imageFile): self
    {
        $this->imageFile = $imageFile;

        if($this->imageFile instanceof UploadedFile) {
            $this->updatedAt = new \DateTime();
        }

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get the value of type
     */ 
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set the value of type
     *
     * @return  self
     */ 
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }
}
