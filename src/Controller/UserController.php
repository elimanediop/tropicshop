<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    /**
     * @Route("/profil", name="profil_user")
     */
    public function index()
    {
        return $this->render('user/profil_home_user.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }
}
