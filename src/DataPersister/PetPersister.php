<?php

namespace App\DataPersister;

use ApiPlatform\Core\DataPersister\DataPersisterInterface;
use App\Entity\Pet;
use App\Entity\TypePet;
use App\Repository\TypePetRepository;
use Doctrine\ORM\EntityManagerInterface;

class PetPersister implements DataPersisterInterface
{
    protected $em;

    protected $repoTypePet;

    public function __construct(EntityManagerInterface $em, TypePetRepository $repoTypePet)
    {
        $this->em = $em;
        $this->repoTypePet = $repoTypePet;
    }

    public function supports($data): bool
    {
        return $data instanceof Pet;
    }

    public function persist($data, array $context = [])
    {
        $typePet = $this->repoTypePet->findByName($data->getType());

        $data->setTypePet($typePet);
        $data->setCreatedAt(new \DateTime());

        $this->em->persist($data);
        $this->em->flush();
    }

    public function remove($data)
    {
        $this->em->remove($data);
        $this->em->flush();
    }
}
