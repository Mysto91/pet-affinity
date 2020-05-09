<?php

namespace App\DataProvider;

use ApiPlatform\Core\DataProvider\ItemDataProviderInterface;
use ApiPlatform\Core\DataProvider\SerializerAwareDataProviderInterface;
use ApiPlatform\Core\DataProvider\SerializerAwareDataProviderTrait;
use ApiPlatform\Core\Exception\ResourceClassNotSupportedException;
use App\Entity\Pet;
use App\Entity\TypePet;
use App\Repository\PetRepository;
use App\Repository\TypePetRepository;

final class PetItemProvider implements ItemDataProviderInterface, SerializerAwareDataProviderInterface
{
    use SerializerAwareDataProviderTrait;
    
    protected $petRepo;

    protected $typePetRepo;

    public function __construct(PetRepository $repoPet, TypePetRepository $typePetRepo)
    {
        $this->repoPet = $repoPet;
        $this->typePetRepo = $typePetRepo;
    }

    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return Pet::class === $resourceClass;
    }

    public function getItem(string $resourceClass, $id, string $operationName = null, array $context = []): ?Pet
    {
        $pet = $this->repoPet->findById($id);
        $pet = $this->setPetType($pet);
        
        return $pet;
    }

    public function setPetType(Pet $pet): ?Pet
    {
        $typePetId = $pet->getTypePet()->getId();
        $type = $this->typePetRepo->findNameById($typePetId);
        $pet->setType($type);

        return $pet;
    }
}