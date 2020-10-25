<?php

namespace App\Controller;

use App\Entity\TypeProduit;
use App\Form\TypeProduitType;
use App\Repository\TypeProduitRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    private $title = "Admin space";
    /**
     * @Route("/admin", name="admin")
     */
    public function index()
    {
        return $this->render('admin/index.html.twig', [
            "title" => $this->title
        ]);
    }

    /**
     * @Route("/admin/createtypeproduit", name="createtypeproduit")
     */
    public function createTypeProduit(Request $request, TypeProduitRepository $typeProduitRepository, ObjectManager $manager)
    {
        $typeProuit = new TypeProduit();
        $form = $this->createForm(TypeProduitType::class, $typeProuit);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            //if($role == "admin") { //TODO must be admin
            $manager->persist($typeProuit);
            $manager->flush();
            //}

            return $this->redirectToRoute("admin");
        }

        return $this->render('admin/profil_home.html.twig', [
            'form' => $form->createView(), "title" => $this->title, "h1" => "Creation d'un type de produit"
        ]);
    }
}
