<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\LoginType;
use App\Form\RegistrationType;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class SecurityController extends AbstractController
{
    /**
     * @Route("/register", name="security_registration")
     */
    public function registration(Request $request, EntityManagerInterface $manager, UserPasswordEncoderInterface $encoder)
    {
        $user = new User;
        $form = $this->createForm(RegistrationType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            //Encodage du mot de passe
            $hash = $encoder->encodePassword($user, $user->getPassword());

            $user->setCreatedAt(new \DateTime());
            $user->setPassword($hash);

            $manager->persist($user);
            $manager->flush();

            return $this->redirectToRoute('security_login');
        }

        return $this->render(
            'security/registration.html.twig',
            [
                'form' => $form->createView()
            ]
        );
    }

    /**
     * @Route("/connection", name="security_login")
     */
    public function login()
    {
        $user = new User;
        $form = $this->createForm(LoginType::class, $user);

        //$form->handleRequest($request);

        return $this->render(
            'security/login.html.twig',
            [
                'formLogin' => $form->createView()
            ]
        );
    }
}