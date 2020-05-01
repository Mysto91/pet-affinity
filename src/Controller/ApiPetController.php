<?php

namespace App\Controller;

use App\Entity\Pet;
use App\Entity\TypePet;
use App\Repository\PetRepository;
use App\Repository\TypePetRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Exception\NotEncodableValueException;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ApiPetController extends AbstractController
{
    /**
     * @Route("/api/pet", name="api_pet_get", methods={"GET"})
     */
    public function apiGet(PetRepository $repo)
    {
        return $this->json($repo->findAll(), 200, [], ['groups' => 'pet:read']);
    }

    /**
     * @Route("/api/pet", name="api_pet_post", methods={"POST"})
     */
    public function apiPost(Request $request, SerializerInterface $serializer, EntityManagerInterface $em, TypePetRepository $typeRepo, ValidatorInterface $validator)
    {
        try {
            $params = $request->getContent();

            $paramObject = json_decode($params);

            $pet = $serializer->deserialize($params, Pet::class, 'json');
            $pet->setCreatedAt(new \DateTime());

            $typePet = new TypePet();

            if (!empty($typeRepo->findByName($paramObject->type)))
                $typePet = $typeRepo->findByName($paramObject->type);

            $pet->setTypePet($typePet);

            $errors = $validator->validate($pet);

            if (count($errors) > 0) {
                return $this->json($errors, 400);
            } else {
                $em->persist($pet);
                $em->flush();

                return $this->json($pet, 201, [], ['groups' => 'pet:read']);
            }
        } catch (NotEncodableValueException $e) {
            return $this->json([
                'status' => 400,
                'message' => $e->getMessage()
            ]);
        }
    }
}
