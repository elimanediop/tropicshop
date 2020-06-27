<?php

namespace App\Controller;

use App\Entity\Client;
use App\Repository\ClientRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ClientController extends AbstractController
{
    /**
     * @Route("/profil", name="profil")
     */
    public function index(Request $request, ClientRepository $clientRepository)
    {
        $id = 8;//TODO get client by id from request
        $client = $clientRepository->find($id);
        return $this->render('client/index.html.twig', [
            'user' => $client,
        ]);
    }
}
