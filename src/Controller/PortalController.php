<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Feature;
use App\Form\FeatureType;
use App\Repository\FeatureRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class PortalController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     */
    public function home()
    {
        return $this->render('portal/home.html.twig', [
            'username' => 'Admin',
            'url' => '/home'
        ]);
    }

    /**
     * @Route("/features", name="features")
     */
    public function features(FeatureRepository $repo)
    {
        $feature_array = $repo->findAll();
        return $this->render('portal/features.html.twig', [
            'controller_name' => 'PortalController',
            'features' => $feature_array,
        ]);
    }

    /**
     * @Route("/about", name="about")
     */
    public function about()
    {
        return $this->render('portal/about.html.twig', [
            'controller_name' => 'PortalController',
        ]);
    }

    /**
     * @Route("/feature/new", name="feature_create")
     * @Route("/feature/{id}/edit", name="feature_edit")
     */
    public function createFeature(Feature $feature = null, Request $request, EntityManagerInterface $manager)
    {
        if (!$feature) {
            $feature = new Feature();
        }

        $form = $this->createForm(FeatureType::class, $feature);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if ($feature->getId()) {
                $feature->setCreatedAt(new \DateTime());
            }
            $manager->persist($feature);
            $manager->flush();

            return $this->redirectToRoute('feature', [
                'id' => $feature->getId()
            ]);
        }

        return $this->render(
            'feature/create.html.twig',
            [
                'formFeature' => $form->createView(),
                'editMode' => $feature->getId() !== null,
            ]
        );
    }

    /**
     * @Route("/feature/{id}", name="feature")
     */
    public function feature(Feature $feature)
    {
        return $this->render('portal/feature.html.twig', [
            'feature' => $feature,
        ]);
    }
}
