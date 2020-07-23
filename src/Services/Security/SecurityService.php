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
            throw new \Exception("Activer votre compte ! \n vérifier votre boite mail : ". $user->getMail());
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