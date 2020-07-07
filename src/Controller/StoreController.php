<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Form\ProduitType;
use App\Repository\ProduitRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

class StoreController extends AbstractController
{
    private $title_home = "Espace de gestion magasin";
    private $title_add_produit = "Espace de gestion magasin - ajouter un produit";
    private $title_edit_produit = "Espace de gestion magasin - modifier un produit";
    private $title_delete_produit = "Espace de gestion magasin - supprimer un produit";
    /**
     * @Route("/store", name="store_profil")
     */
    public function index(Request $request, ProduitRepository $produitRepository)
    {
        $this->products = $produitRepository->findByUserId($this->getUser()->getId());
        return $this->render('store/profil_home.html.twig', [
            'title' => $this->title_home,
            'products' => $this->products
        ]);
    }

    /**
     * @Route("/store/ajouter_produit", name="store_profil_add_product")
     */
    public function addProduct(Request $request, ObjectManager $manager, SluggerInterface $slugger)
    {
        $produit = new Produit();
        $form = $this->createForm(ProduitType::class, $produit);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $brochureFile = $form->get('imagesproduit')->getData();
            $produit->setStore($this->getUser());

            if ($brochureFile) {
                $originalFilename = pathinfo($brochureFile->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$brochureFile->guessExtension();

                try {
                    $brochureFile->move(
                        $this->getParameter('images_product_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }

                $produit->setImagesproduit($newFilename);
                $produit->setImages($produit->getImagesproduit());
            }

            $manager->persist($produit);
            $manager->flush();
            return $this->redirectToRoute("store_profil", [
                'title' => $this->title_home
            ]);
        }

        return $this->render('store/profil_home.html.twig', [
        'title' => $this->title_add_produit,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/store/modifier_produit", name="store_profil_edit_product")
     */
    public function editProduct(Request $request, ObjectManager $manager, ProduitRepository $produitRepository, SluggerInterface $slugger)
    {
        $id = $request->query->get('id');
        if(is_null($id)){
            return $this->redirectToRoute("store_profil", [
                'title' => $this->title_home
            ]);
        }
        $produit = $produitRepository->find($id);

        $form = $this->createForm(ProduitType::class, $produit);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $brochureFile = $form->get('imagesproduit')->getData();

            if ($brochureFile) {
                $originalFilename = pathinfo($brochureFile->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$brochureFile->guessExtension();

                try {
                    $brochureFile->move(
                        $this->getParameter('images_product_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }

                $produit->setImagesproduit($newFilename);
                $produit->setImages($produit->getImagesproduit());
            }

            $manager->persist($produit);
            $manager->flush();
            return $this->redirectToRoute("store_profil", [
                'title' => $this->title_home
            ]);
        }



        return $this->render('store/profil_home.html.twig', [
            'title' => $this->title_edit_produit,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/store/supprimer_produit", name="store_profil_delete_product")
     */
    public function deleteProduct()
    {
        return $this->render('store/profil_home.html.twig', [
            'title' => $this->title_delete_produit
        ]);
    }
}

