<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Feature;
use App\Repository\FeatureRepository;

class PortalController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     */
    public function home(){
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
     * @Route("/feature/{id}", name="feature")
     */
    public function feature(Feature $feature)
    {
        return $this->render('portal/feature.html.twig', [
            'feature' => $feature,
        ]);
    }
}
