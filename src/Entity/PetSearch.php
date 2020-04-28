<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class PetSearch
{

    private $maxSize;

    private $maxAge;

    /**
     * Get the value of maxSize
     * @Assert\Range(min=1, max=100)
     * @return  int
     */
    public function getMaxSize(): ?int
    {
        return $this->maxSize;
    }

    /**
     * Set the value of maxSize
     *
     * @return  self
     */
    public function setMaxSize(int $maxSize): self
    {
        $this->maxSize = $maxSize;

        return $this;
    }

    /**
     * Get the value of maxAge
     * @return  int
     */
    public function getMaxAge(): ?int
    {
        return $this->maxAge;
    }

    /**
     * Set the value of maxAge
     *
     * @return  self
     */
    public function setMaxAge(int $maxAge): self
    {
        $this->maxAge = $maxAge;

        return $this;
    }
}
