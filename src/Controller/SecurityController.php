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
use App\Form\NewMailType;
use App\Form\NewAddressType;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    private $userPasswordEncoder;
    private $manager;
    private $mailer;
    private $userRepository;

    /**
     * SecurityController constructor.
     * @param UserPasswordEncoderInterface $userPasswordEncoder
     * @param \Swift_Mailer $mailer
     * @param ObjectManager $manager
     */
    public function __construct(UserRepository $userRepository, UserPasswordEncoderInterface $userPasswordEncoder,  \Swift_Mailer $mailer, ObjectManager $manager)
    {
        $this->userPasswordEncoder = $userPasswordEncoder;
        $this->manager = $manager;
        $this->mailer = $mailer;
        $this->userRepository = $userRepository;
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
        $message = (new \Swift_Message('Confirmation| activation compte Tropicshop'))
            ->setFrom('do-not-reply@tropicshop.fr')
            ->setTo($client->getMail())
            ->setCc("do-not-reply@tropicshop.fr")
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

    private function checkLink(string $encryptlink){
      $decodLink = base64_decode($encryptlink);
      $linkData = explode("|", $decodLink);

      return $this->userRepository->findOneByEmail($linkData[0]);
    }

    /**
     * @Route("/confimationAccount/{encryptlink}", name="security_confimationAccount")
     */
    public function confirmationAccount(string $encryptlink){

        $client = $this->checkLink($encryptlink);
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
   public function passwordForgotten(Request $request){
     if ($request->isMethod('POST')) {
       $baseUrl = (explode("/",$request->server->get('HTTP_REFERER')))[2];
       $email = ($request->request->get('_username'));
       $user = $this->userRepository->findOneByEmail($email);

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
       $message = (new \Swift_Message('Mot de passe oublié | Comtpe Tropicshop'))
           ->setFrom('do-not-reply@tropicshop.fr')
           ->setTo($client->getMail())
           ->setBody("Bonjour, Pour changer le mot de passe de votre compte Tropicshop, cliquez ici: $url".$client->getLink());
       $this->mailer->send($message);
       return $message;
   }


   /**
    * @Route("/newPassword/{encryptlink}", name="security_newPassword")
    */
  public function newPassword(string $encryptlink, Request $request){
    $client = $this->checkLink($encryptlink, $this->userRepository);
    $form = $this->createForm(NewPasswordType::class, $client);
    $form->handleRequest($request);
    if ($request->isMethod('POST')) {
      if($form->isSubmitted() && $form->isValid()){
        $hash = $this->userPasswordEncoder->encodePassword($client, $client->getPassword());
        $client->setPassword($hash);
        $this->save($client);
        return $this->redirectToRoute("security_login");
      }

    }
    return $this->render('security/new_password.html.twig', [
      'form' => $form->createView(),
    ]);
  }

  /**
   * @Route("/changeMail", name="security_changeMail")
   */
  public function changeMail(Request $request){
    $client = $this->userRepository->findOneByEmail($this->getUser()->getMail());
    $email = $this->getUser()->getMail();
    $form = $this->createForm(NewMailType::class, $client);
    $form->handleRequest($request);
    if($form->isSubmitted() && $form->isValid()){
      $this->save($client);
      //TODO make function clear
      $message = (new \Swift_Message('Confirmation| Mail compte Tropicshop'))
          ->setFrom('do-not-reply@tropicshop.fr')
          ->setTo($client->getMail())
          ->setBody("Bonjour, le changement de votre mail a été bien pris en compte. Votre nouveau mail est ".$client->getMail()." et l'ancien est $email");
      $this->mailer->send($message);

      return $this->redirectToRoute("store_profil");
    }
    return $this->render('security/new_mail.html.twig', [
      'form' => $form->createView(),
    ]);
  }

  /**
  * @Route("/changeAddress", name="security_changeAddress")
  */
  public function changeAddress(Request $request){
    $client = $this->userRepository->findOneByEmail($this->getUser()->getMail());
    $adresse = $this->getUser()->getAdresse();
    $user = new User();
    $form = $this->createForm(NewAddressType::class, $user);
    $form->handleRequest($request);
    if($form->isSubmitted() && $form->isValid()){
      if(!$user->getLat() || !$user->getLon() || ($user->getLat() === $client->getLat() && $user->getLon() === $client->getLon())){
        $error = "Veuillez saisir votre adresse et la selectionner dans la liste suggérée sous le champs d'adresse.";
        return $this->render('security/new_address.html.twig', [
          'form' => $form->createView(),
          'error' => $error
        ]);
      }
      //TODO save address, city and zipcode
      $city_zip = explode(" ", explode("," ,$user->getAdresseComplete())[1]);
      $client->setLat($user->getLat())
              ->setLon($user->getLon())
              ->setAdresse($user->getAdresseComplete())
              ->setCodepostal($city_zip[1])
              ->setVille($city_zip[2]);
      $this->save($client);
      //TODO make function clear
      $message = (new \Swift_Message('Confirmation| Adresse compte Tropicshop'))
          ->setFrom('do-not-reply@tropicshop.fr')
          ->setTo($client->getMail())
          ->setBody("Bonjour, le changement de votre adresse a été bien prise en compte. Votre nouvelle adresse est ".$client->getAdresse());
      $this->mailer->send($message);

      return $this->redirectToRoute("store_profil");
    }
    return $this->render('security/new_address.html.twig', [
      'form' => $form->createView()
    ]);
  }

  /**
  * @Route("/deleteAccount", name="security_deleteAccount")
  */
  public function deleteAccount(){

  }


  /**
   * @Route("/login", name="security_login")
   */
  public function login(AuthenticationUtils $authenticationUtils){

      return $this->render("security/login.html.twig", [
          'error'=> ""
      ]);
  }

  /**
   * @Route("/send_link_actived_account/{encryptlink}", name="security_send_link_actived_account")
   */
  public function login_error_send_link_actived_account(string $encryptlink,
                AuthenticationUtils $authenticationUtils, Request $request){
      $baseUrl = (explode("/",$request->server->get('HTTP_REFERER')))[2];
      $this->confimationMail($this->checkLink($encryptlink), $baseUrl);
      return $this->render("security/login_error.html.twig");
  }

  /**
   * @Route("/logout", name="security_logout")
   */
  public function logout(){ }

  /**
   * @Route("/login_error", name="security_login_error")
   */
  public function login_error(AuthenticationUtils $authenticationUtils){
    $error = $authenticationUtils->getLastAuthenticationError();
    return $this->render("security/login.html.twig", [
        'error'=> $error
    ]);
  }
}
