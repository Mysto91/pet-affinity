<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Feature;
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
     */
    public function createFeature(Request $request, EntityManagerInterface $manager)
    {
        $feature = new Feature();

        $form = $this->createFormBuilder($feature)
            ->add('name')
            ->add('description')
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $feature->setCreatedAt(new \DateTime());
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
