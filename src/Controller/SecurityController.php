<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\User;
use App\Form\RegistrationType;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class SecurityController extends AbstractController
{
    /**
   * @Route("/registration/{role}", name="security_registration", defaults={"role":"user"})
   */
  public function registration(Request $request, UserPasswordEncoderInterface $userPasswordEncoder,ObjectManager $manager)
  {
      $role = '';
      $client = new User();

      $form = $this->createForm(RegistrationType::class, $client);
      $form->handleRequest($request);

      if($form->isSubmitted() && $form->isValid()){
          $hash = $userPasswordEncoder->encodePassword($client, $client->getPassword());
          $client->setPassword($hash);
          $manager->persist($client);
          $manager->flush();

          return $this->redirectToRoute("security_login");
      }

      return $this->render('security/registration.html.twig', [
          'form' => $form->createView()
      ]);

  }

  /**
   * @Route("/login", name="security_login")
   */
  public function login(){
      return $this->render("security/login.html.twig");
  }

  /**
   * @Route("/logout", name="security_logout")
   */
  public function logout(){ }
}
