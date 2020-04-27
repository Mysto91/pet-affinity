<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Pet;
use App\Repository\PetRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;

class PetManagementController extends AbstractController
{
    /**
     * @Route("/pet/management", name="pet_management")
     */
    public function index( PetRepository $repo, PaginatorInterface $paginator, Request $request)
    {
        $pets_array = $paginator->paginate(
            $repo->findAllQuery(),
            $request->query->getInt('page', 1),
            5
        );

        return $this->render('pet_management/index.html.twig', [
            'pets' => $pets_array
        ]);
    }
}
