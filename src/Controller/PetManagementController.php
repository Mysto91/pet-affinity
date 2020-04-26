<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Pet;
use App\Repository\PetRepository;

class PetManagementController extends AbstractController
{
    /**
     * @Route("/pet/management", name="pet_management")
     */
    public function index(PetRepository $repo)
    {
        $pet_array = $repo->findAll();
        return $this->render('pet_management/index.html.twig', [
            'pets' => $pet_array
        ]);
    }
}
