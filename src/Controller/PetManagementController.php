<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Pet;
use App\Entity\PetSearch;
use App\Form\CreatePetType;
use App\Form\SearchPetType;
use App\Repository\PetRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;

class PetManagementController extends AbstractController
{
    /**
     * @Route("/pet", name="pet_management")
     */
    public function index(PetRepository $repo, PaginatorInterface $paginator, Request $request)
    {
        $search = new PetSearch();

        $form = $this->createForm(SearchPetType::class, $search);
        $form->handleRequest($request);

        $pets_array = $paginator->paginate(
            $repo->findAllQuery($search),
            $request->query->getInt('page', 1),
            10
        );

        return $this->render('pet_management/index.html.twig', [
            'pets' => $pets_array,
            'form_search' => $form->createView()
        ]);
    }

        /**
     * @Route("/pet/new", name="pet_create")
     * @Route("/pet/edit/{id}", name="pet_edit")
     */
    public function createPet(Pet $pet = null, Request $request, EntityManagerInterface $manager)
    {
        if(!$pet) {
            $pet = new Pet();
        }

        $form = $this->createForm(CreatePetType::class, $pet);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if (!$pet->exist()) {
                $pet->setCreatedAt(new \DateTime());
            }
            $manager->persist($pet);
            $manager->flush();

            return $this->redirectToRoute('pet_management');
        }

        return $this->render(
            'pet_management/create.html.twig',
            [
                'formPet' => $form->createView(),
                'editMode' => $pet->getId() !== null,
            ]
        );

    }
}
