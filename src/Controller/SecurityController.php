<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\User;
use App\Form\RegistrationType;
use App\Form\NewPasswordType;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    private $userPasswordEncoder;
    private $manager;
    private $mailer;

    /**
     * SecurityController constructor.
     * @param UserPasswordEncoderInterface $userPasswordEncoder
     * @param \Swift_Mailer $mailer
     * @param ObjectManager $manager
     */
    public function __construct(UserPasswordEncoderInterface $userPasswordEncoder,  \Swift_Mailer $mailer, ObjectManager $manager)
    {
        $this->userPasswordEncoder = $userPasswordEncoder;
        $this->manager = $manager;
        $this->mailer = $mailer;
    }
    /**
   * @Route("/registration", name="security_registration")
   */
  public function registration(Request $request)
  {
      $role = '';
      $client = new User();

      $form = $this->createForm(RegistrationType::class, $client);
      $form->handleRequest($request);

      if($client->getRole() && $form->isSubmitted() && $form->isValid()){
          $baseUrl = (explode("/",$request->server->get('HTTP_REFERER')))[2];
          $hash = $this->userPasswordEncoder->encodePassword($client, $client->getPassword());
          $client->setPassword($hash);
          $client->setActivated(false);
          $client->setLink($this->linkConfirmation($client));
          $this->save($client);
          $this->confimationMail($client, $baseUrl);
          return $this->redirectToRoute("security_login");
      }

      return $this->render('security/registration.html.twig', [
          'form' => $form->createView()
      ]);

  }
    private function linkConfirmation(User $client){
        return base64_encode($client->getMail()."|". date("Y-m-d H:i"));
    }

    /**
     * @param User $client
     * @param string $baseUrl
     * @return \Swift_Message
     */

    private function confimationMail(User $client, string $baseUrl){
        $url = "http://".$baseUrl."/confimationAccount/";
        $message = (new \Swift_Message('Confirmation| activation compte'))
            ->setFrom('contact@tropicshop.fr')
            ->setTo($client->getMail())
            ->setBody("Bonjour, Pour activer votre compte cliquez ici: $url".$client->getLink());
        $this->mailer->send($message);
        return $message;
    }

    /**
     * @Route("/account", name="account")
     */
    public function account(Request $request)
    {
        if($this->getUser()->getRoles()[0] == "ROLE_CLIENT"){
            return $this->redirectToRoute("home");

        }
        if($this->getUser()->getRoles()[0] == "ROLE_STORE"){
            return $this->redirectToRoute("store_profil");
        }

        return $this->render("security/login.html.twig");
    }

    public function checkLink(string $encryptlink, UserRepository $userRepository){
      $decodLink = base64_decode($encryptlink);
      $linkData = explode("|", $decodLink);

      return $userRepository->findOneByEmail($linkData[0]);
    }

    /**
     * @Route("/confimationAccount/{encryptlink}", name="security_confimationAccount")
     */
    public function confirmationAccount(string $encryptlink, UserRepository $userRepository){

        $client = $this->checkLink($encryptlink, $userRepository);
        $client->setActivated(true);
        $this->save($client);

        return $this->render("main/confirmAccount.html.twig");
    }
    private function save($user){
        $this->manager->persist($user);
        $this->manager->flush();
    }

    /**
     * @Route("/passwordForgotten", name="security_passwordForgotten")
     */
   public function passwordForgotten(Request $request, UserRepository $userRepository){
     if ($request->isMethod('POST')) {
       $baseUrl = (explode("/",$request->server->get('HTTP_REFERER')))[2];
       $email = ($request->request->get('_username'));
       $user = $userRepository->findOneByEmail($email);

       if(!$user){
        return  $this->render('security/password_forgotten.html.twig', [
          'error' => "Cet utilisateur n'existe pas chez Tropicshop. Veuillez créer un compte !"
          ]);
        }
      $user->setLink($this->linkConfirmation($user));
      $this->save($user);
      $this->passwordForgottenMail($user, $baseUrl);
      return $this->redirectToRoute("security_login");
     }

     return $this->render('security/password_forgotten.html.twig');
   }

   /**
    * @param User $client
    * @param string $baseUrl
    * @return \Swift_Message
    */

   private function passwordForgottenMail(User $client, string $baseUrl){
       $url = "http://".$baseUrl."/newPassword/";
       $message = (new \Swift_Message('Mot de passe oublié'))
           ->setFrom('contact@tropicshop.fr')
           ->setTo($client->getMail())
           ->setBody("Bonjour, Pour changer le mot de passe de votre compte Tropicshop, cliquez ici: $url".$client->getLink());
       $this->mailer->send($message);
       return $message;
   }


   /**
    * @Route("/newPassword/{encryptlink}", name="security_newPassword")
    */
  public function newPassword(string $encryptlink, Request $request, UserRepository $userRepository){
    $client = $this->checkLink($encryptlink, $userRepository);
    $password = new \stdCLass;
    $password->password = null;
    $password->confirm_password = null;
    $form = $this->createForm(NewPasswordType::class, $password);
    $form->handleRequest($request);
    if ($request->isMethod('POST')) {
      if($form->isSubmitted() && $form->isValid()){
        dd($password);
      }

    }
    return $this->render('security/new_password.html.twig', [
      'form' => $form->createView()
    ]);
  }

  /**
   * @Route("/login", name="security_login")
   */
  public function login(AuthenticationUtils $authenticationUtils){
      $error = $authenticationUtils->getLastAuthenticationError();
      return $this->render("security/login.html.twig", [
          'error'=> $error
      ]);
  }

  /**
   * @Route("/logout", name="security_logout")
   */
  public function logout(){ }
}
