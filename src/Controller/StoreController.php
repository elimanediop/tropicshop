<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Entity\ProduitStore;
use App\Form\ProduitStoreType;
use App\Form\ProduitType;
use App\Repository\ProduitRepository;
use App\Repository\ProduitStoreRepository;
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
    private $manager;
    private $produitRepository;
    private $produitStoreRepository;
    private $previewProduct;

    public function __construct(ObjectManager $manager, ProduitStoreRepository $produitStoreRepository,ProduitRepository $produitRepository)
    {
        $this->manager = $manager;
        $this->produitRepository = $produitRepository;
        $this->produitStoreRepository = $produitStoreRepository;
    }
    /**
     * @Route("/store", name="store_profil")
     */
    public function index(Request $request)
    {
        $products = $this->produitRepository->findBy(["store"=> $this->getUser()]);
        return $this->render('store/profil_home.html.twig', [
            'title' => $this->title_home,
            'products' => $products
        ]);
    }

    /**
     * @Route("/store/ajouter_produit", name="store_profil_add_product")
     */
    public function addProduct(Request $request, SluggerInterface $slugger)
    {
        $produitStore = new ProduitStore();
        $produit = new Produit();
        $produits = $this->produitRepository->findAll();
        //$form = $this->createForm(ProduitStoreType::class, $produitStore);
        //$form->handleRequest($request);

        /*
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

            $this->manager->persist($produit);
            $this->manager->flush();
            return $this->redirectToRoute("store_profil", [
                'title' => $this->title_home
            ]);
        }
        */

        return $this->render('components/store/select_produit.html.twig', [
        'title' => $this->title_add_produit,
            'products' => $produits
        ]);
    }

    /**
     * @Route("/store/ajouter_produit_store/{product_id}", name="addProductToStore")
     */
    public function addProductToStore(Request $request, string $product_id){
        //TODO create product store and allow edition
        $produitStore = new Produit();
        $produit = $this->produitRepository->find($product_id);

        $form = $this->createForm(ProduitType::class, $produit);
        $form->handleRequest($request);
        $error = "";

        if($form->isSubmitted() && $form->isValid()) {
            if(count($this->produitRepository->findBy([
                "store" => $this->getUser(),
                "nom" => $produit->getNom(),
                "origine" => $produit->getOrigine()
            ])) == 0 && $produit->getPrix() != 0){
                $store =  $this->getUser();
                $already = $this->produitRepository->findBy([
                    "store" => $store,
                    "nom" => $produit->getNom(),
                    "origine" => $produit->getOrigine()
                ]);
                $produitStore->setNom($produit->getNom())
                    ->setIsdefault(false)
                    ->setStore($store)
                    ->setPrix($produit->getPrix())
                    ->setOrigine($produit->getOrigine())
                    ->setDescription($produit->getDescription())
                    ->setImagesproduit($produit->getImagesproduit())
                    ->setImages($produit->getImages()[0])
                    ->setTypeproduit($produit->getTypeproduit())
                ;

                $produit->setPrix(0);

                $this->save($produitStore);
                return $this->redirectToRoute("store_profil");
            }else{
                $error = "Apparemment vous avez déjà ce produit dans votre store ou le prix saisi est 0.";
            }
        }

        $this->previewProduct = $produit;
        return $this->render("components/store/edit_product_for_store.html.twig", [
            "form" => $form->createView(),
            "error" => $error
        ]);
    }

    public function save($produitStore){
        $this->manager->persist($produitStore);
        $this->manager->flush();
    }

    /**
     * @Route("/store/modifier_produit", name="store_profil_edit_product")
     */
    public function editProduct(Request $request, SluggerInterface $slugger)
    {
        $id = $request->query->get('id');
        $error = "";
        if(is_null($id)){
            return $this->redirectToRoute("store_profil", [
                'title' => $this->title_home
            ]);
        }
        $produit = $this->produitRepository->find($id);

        $form = $this->createForm(ProduitType::class, $produit);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid() && $produit->getPrix() != 0) {

            $this->manager->persist($produit);
            $this->manager->flush();
            return $this->redirectToRoute("store_profil", [
                'title' => $this->title_home
            ]);
        }else{
            $error = "Apparemment vous avez saisi un prix égal à 0.";
        }



        return $this->render('store/profil_home.html.twig', [
            'title' => $this->title_edit_produit,
            'form' => $form->createView(),
            'error' => $error
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

