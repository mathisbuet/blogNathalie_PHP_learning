<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationType;

use Doctrine\ORM\EntityManagerInterface;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\HttpFoundation\Response;

class SecurityController extends AbstractController
{
    /**
     * @Route("/inscription", name="security_registration")
     */
    public function registration(Request $request, EntityManagerInterface $manager, UserPasswordEncoderInterface $encoder){
        $user = new User();

        $form=$this->createForm(RegistrationType::class, $user);

        $form->handleRequest($request); //analyse la requete du form rempli

        if($form->isSubmitted() && $form->isValid()){
            $hash= $encoder->encodePassword($user, $user->getPassword());

            $user->setPassword($hash);
            $user->getRoles();

            $manager->persist($user);
            $manager->flush();

            return $this->redirectToRoute('security_login');
        }


        return $this->render('security/registration.html.twig',[
            'formRegistration' => $form->createView()
        ]);
        
    }

    /**
     * @Route("/connexion", name="security_login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response{

        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();


        return $this->render('security/login.html.twig', [
            'lastUsername' => $lastUsername,
            'error' => $error
        ]);

    }

    /**
     * @Route("/deconnexion", name="security_logout")
     */
    public function logout(){}
}
