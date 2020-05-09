<?php

namespace App\DataProvider;

use ApiPlatform\Core\DataProvider\CollectionDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use App\Entity\Pet;
use App\Entity\TypePet;
use App\Repository\PetRepository;
use App\Repository\TypePetRepository;

final class PetCollectionProvider implements CollectionDataProviderInterface, RestrictedDataProviderInterface
{   
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

    public function getCollection(string $resourceClass, string $operationName = null): \Generator
    {
        $petArray = $this->repoPet->findAll();
        foreach ($petArray as $pet) {
            $pet = $this->setPetType($pet);
            yield $pet;
        }
    }

    public function setPetType(Pet $pet): ?Pet
    {
        $typePetId = $pet->getTypePet()->getId();
        $type = $this->typePetRepo->findNameById($typePetId);
        $pet->setType($type);

        return $pet;
    }
}