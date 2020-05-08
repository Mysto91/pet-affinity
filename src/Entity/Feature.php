<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FeatureRepository")
 * @ApiResource(
 *      normalizationContext={
 *          "groups"={
 *              "feature:read"
 *          }
 *      },
 * 
 *      denormalizationContext={
 *          "groups"={
 *              "feature:write"
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
class Feature
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"feature:read", "feature:write"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     * @Assert\Length(
     *          min=5,
     *          max=50,
     *          minMessage="Le nom doit comporter au minimum {{ limit }} caractères",
     *          maxMessage="Le nom doit composer au maximum {{ limit }} caractères")
     * @Assert\NotBlank()
     * @Groups({"feature:read", "feature:write"})
     */
    private $Name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Length(min=5, max=255)
     * @Assert\NotBlank()
     * @Groups({"feature:read", "feature:write"})
     */
    private $Description;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

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

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function exist()
    {
        return $this->getId() != null;
    }
}
