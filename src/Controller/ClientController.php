<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ClientController extends AbstractController
{
    /**
     * @Route("/profil", name="profil")
     */
    public function index(Request $request, UserRepository $clientRepository)
    {
        $id = 8;//TODO get client by id from request
        $client = $clientRepository->find($id);
        return $this->render('client/index.html.twig', [
            'user' => $client,
        ]);
    }
}
