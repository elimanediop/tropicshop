<?php

namespace App\Controller;

use App\Entity\Store;
use App\Form\StoreType;
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
   * @Route("/registration/{role}", name="security_registration", defaults={"role"="user"})
   */
  public function registration(Request $request, string $role, UserPasswordEncoderInterface $userPasswordEncoder,ObjectManager $manager)
  {
      $client = new User();
      if($role == "store"){
        $store = new Store();
        $form = $this->createForm(StoreType::class, $store);
      }

      if($role === "user"){
          $form = $this->createForm(RegistrationType::class, $client);
      }

      $form->handleRequest($request);

      if($form->isSubmitted() && $form->isValid()){
          if($role == "store") {
              $client = $store->getManager();
              $hash = $userPasswordEncoder->encodePassword($client, $client->getCliMdp());
              $client->setCliMdp($hash);
              $client->setRole("ROLE_MANAGER_STORE");
              $manager->persist($store);
              $manager->flush();
          }

          if($role === "user"){
              $hash = $userPasswordEncoder->encodePassword($client, $client->getCliMdp());
              $client->setCliMdp($hash);
              $manager->persist($client);
              $manager->flush();
          }

          return $this->redirectToRoute("security_login");
      }

      if($role == "store"){
          return $this->render('security/registration_store.html.twig', [
              'form' => $form->createView()
          ]);
      }

      if($role === "user"){
          return $this->render('security/registration.html.twig', [
              'form' => $form->createView()
          ]);
      }

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
