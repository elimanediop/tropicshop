<?php


namespace App\Services\Security;


use App\Entity\User;
use Symfony\Component\Security\Core\User\UserCheckerInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class SecurityService implements UserCheckerInterface
{

    /**
     * @inheritDoc
     * @throws \Exception
     */
    public function checkPreAuth(UserInterface $user)
    {
        if (!$user instanceof User) {
            return;
        }
        if ($user->getActivated() === false){

          exit('<div class="">
              <h1 class="text-danger">Votre compte n\'est pas encore activé !
              </h1>
              <p>Vérifiez votre boite mail <strong>'.$user->getMail().'</strong> ou cliquez sur le bouton suivant pour recevoir à nouveau le lien d\'activation de votre compte. <p>
          </div> <button><a href="send_link_actived_account/'.$user->getLink().'" class="post-title">
              <label>Recevoir le lien</label>
          </a></button>');
          //throw new \Exception("Activer votre compte ! \n vérifier votre boite mail : ". $user->getMail());
        }

        return;
        // TODO: Implement checkPreAuth() method.
    }

    /**
     * @inheritDoc
     */
    public function checkPostAuth(UserInterface $user)
    {

        // TODO: Implement checkPostAuth() method.
    }
}
