<?php

namespace App\Controller;

use App\Entity\Origine;
use App\Entity\Produit;
use App\Entity\ProduitStore;
use App\Form\CreateProductStoreType;
use App\Form\ProduitStoreType;
use App\Form\ProduitType;
use App\Form\SearchType;
use App\Repository\OrigineRepository;
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
    private $origieRepository;

    public function __construct(ObjectManager $manager, ProduitStoreRepository $produitStoreRepository,
                                ProduitRepository $produitRepository, OrigineRepository $origineRepository)
    {
        $this->manager = $manager;
        $this->produitStoreRepository = $produitStoreRepository;
        $this->produitRepository = $produitRepository;
        $this->origieRepository = $origineRepository;
    }
    /**
     * @Route("/store", name="store_profil")
     */
    public function index(Request $request)
    {
        $products = $this->produitStoreRepository->findBy(["store"=> $this->getUser()]);
        $searchObj = ["nom" => null];
        $msg = "";
        $searchForm = $this->createForm(SearchType::class, $searchObj);

        $searchForm->handleRequest($request);
        if($searchForm->isSubmitted() && $searchForm->isValid()) {
            $searchObj = $searchForm->getData();
            $resultSearch = $this->produitStoreRepository->findByNameLike($searchObj['nom']);
            if(count($resultSearch))
                $products = $resultSearch;
            else
                $msg = "Aucun produit trouvé avec le nom cherché";
        }
        return $this->render('store/profil_home.html.twig', [
            'title' => $this->title_home,
            'products' => $products,
            "msg" => $msg,
            'searchForm' => $searchForm->createView()
        ]);
    }

    /**
     * @Route("/store/ajouter_produit", name="store_profil_add_product")
     */
    public function addProduct(Request $request)
    {
        $produits = $this->produitRepository->findAll();
        $searchObj = ["nom" => null];
        $msg = "";
        $searchForm = $this->createForm(SearchType::class, $searchObj);

        $searchForm->handleRequest($request);
        if($searchForm->isSubmitted() && $searchForm->isValid()) {
            $searchObj = $searchForm->getData();
            $resultSearch = $this->produitRepository->findByNameLike($searchObj['nom']);
            if(count($resultSearch))
                $produits = $resultSearch;
            else
                $msg = "Aucun produit trouvé avec le nom cherché";
        }

        return $this->render('components/store/select_produit.html.twig', [
        'title' => $this->title_add_produit,
            'products' => $produits,
            "msg" => $msg,
            'searchForm' => $searchForm->createView()
        ]);
    }

    /**
     * @Route("/store/ajouter_produit_store/{product_id}", name="addProductToStore")
     */
    public function addProductToStore(Request $request, string $product_id){
        //TODO create product store and allow edition
        $produitStore = new ProduitStore();
        $produit = $this->produitRepository->find($product_id);
        $produitStore->setProduit($produit);

        $form = $this->createForm(ProduitStoreType::class, $produitStore);
        $form->handleRequest($request);
        $error = "";

        if($form->isSubmitted() && $form->isValid()) {
            $store =  $this->getUser();
            if(is_null($produitStore->getTypevente())){
                $produitStore->setTypevente($produit->getTypevente());
            }
            if(is_null($produitStore->getOrigine())){
                $produitStore->setOrigine($produit->getOrigine());
            }else{
                /**
                 * @var Origine
                 */
                $origne = $produitStore->getOrigine();
                $produitStore->setOrigine($this->origieRepository->findOneBy(["country" => $origne->getCountry()]));
            }
            $produitStore
                ->setStore($store);
            $this->save($produitStore);
            return $this->redirectToRoute("store_profil");

            //$error = "Apparemment vous avez déjà ce produit dans votre store ou le prix saisi est 0.";

        }

        //$this->previewProduct = $produit;
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
        $produitStore = $this->produitStoreRepository->find($id);

        $form = $this->createForm(ProduitStoreType::class, $produitStore);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

            $this->manager->persist($produitStore);
            $this->manager->flush();
            return $this->redirectToRoute("store_profil", [
                'title' => $this->title_home
            ]);
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
    public function deleteProduct(Request $request)
    {
        $produitsStore = $this->produitStoreRepository->findBy(["store" => $this->getUser()]);
        $searchObj = ["nom" => null];
        $msg = "";
        $searchForm = $this->createForm(SearchType::class, $searchObj);

        $searchForm->handleRequest($request);
        if($searchForm->isSubmitted() && $searchForm->isValid()) {
            $searchObj = $searchForm->getData();
            $resultSearch = $this->produitStoreRepository->findByNameLike($searchObj['nom']);
            if(count($resultSearch))
                $produitsStore = $resultSearch;
            else
                $msg = "Aucun produit trouvé avec le nom cherché";
        }

        return $this->render('components/store/delete_produit.html.twig', [
            'title' => $this->title_delete_produit,
            'productsStore' => $produitsStore,
            "msg" => $msg,
            'searchForm' => $searchForm->createView()
        ]);

    }

    /**
     * @Route("/store/supprimer_produit_store/{product_id}", name="deleteProductFromStore")
     */
    public function deleteProductFromStore(Request $request, string $product_id){
        $entityManager = $this->getDoctrine()->getManager();
        $produitStore = $this->produitStoreRepository->find($product_id);
        $entityManager->remove($produitStore);
        $entityManager->flush();
        return $this->redirectToRoute("store_profil_delete_product");

    }
}
