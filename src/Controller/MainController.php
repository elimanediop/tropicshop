<?php

namespace App\Controller;

use App\Entity\TypeProduit;
use App\Form\SearchType;
use App\Repository\ProduitRepository;
use App\Repository\ProduitStoreRepository;
use App\Repository\TypeProduitRepository;
use App\Repository\UserRepository;
use App\Services\Panier\PanierService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\OptionsResolver\Exception\UndefinedOptionsException;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    private $products;
    protected $produitRepository;
    protected $userRepository;
    protected $session;
    private $typeProduits;
    private $typeProduitRepository;
    private $produitStoreRepository;

    public function __construct(ProduitRepository $produitRepository,
                                UserRepository $userRepository, TypeProduitRepository $typeProduitRepository,
                                ProduitStoreRepository $produitStoreRepository)
    {
        $this->produitRepository = $produitRepository;
        $this->userRepository = $userRepository;
        $this->typeProduitRepository = $typeProduitRepository;
        $this->typeProduits = $this->typeProduitRepository->findBy(
            array(),
            array('libelle' => 'ASC')
        );
        $this->produitStoreRepository = $produitStoreRepository;

    }

    /**
     * @Route("/", name="home")
     */
    public function index()
    {
        $this->products = $this->produitRepository->findBy(["isdefault" => true]);
        return $this->render('main/home.html.twig', [
            'products' =>$this->products,
            'typeproduits' => $this->typeProduits
        ]);
    }

    /**
     * @Route("/produit/{product_id}", name="showProduct")
     */
    public function afficherProduitDetail(int $product_id, PanierService $panierService)
    {
        $productStore = $this->produitStoreRepository->find($product_id);
        $cart = $panierService->getProduit();
        //dd($cart);
        return $this->render('main/show_product.html.twig', [
            'productStore' =>$productStore,
            'cart' => $cart
        ]);
    }

    /**
     * @Route("/filter_category/{category}", name="filter_category")
     */
    public function filter(string $category){
        $error = "";

        if($category){
            $this->products = $this->produitRepository->findByTypeproduit($this->typeProduitRepository->findBy(["libelle" => $category]), true);
            return $this->render('main/home.html.twig', [
                'products' =>$this->products,
                'typeproduits' => $this->typeProduits

            ]);
        }

        return $this->redirectToRoute('home');

    }

    /**
     * @Route("/recherche", name="search")
     */
    public function search(Request $request){

        $location = $request->get('top-map');
        $term = $request->get('top-search');
        $lat = $request->get('lat');
        $lon = $request->get('lon');
        $storeProducts=[];

        if(strlen($term) && strlen($location)){
            $storeProducts = $this->produitRepository->findByTermAndLocation($term, $lat, $lon);
        }elseif (strlen($location)){
            $storeProducts = $this->produitRepository->findByLocation($lat,$lon);
        }elseif (strlen($term)){
            $storeProducts = $this->produitRepository->findByTerm($term);
        }else{
            $this->products = $this->produitRepository->findBy(["isdefault" => true]);
        }
        return $this->render('main/home.html.twig', [
            'products' =>$this->products,
            'storeProducts' => $storeProducts,
            'searchTerm' => $term,
            'location' => $location,
            'lon' => $lon,
            'lat' => $lat
        ]);
    }
    /**
     * @Route("/le_produit_par_magasins/{product_id}", name="showProductByStores")
     */
    public function afficherProduitParMagasins(Request $request, int $product_id){
        $storeProducts = $this->produitStoreRepository->findBy(["produit" => $product_id]);
        $searchObj = ["nom" => null];
        $msg = "";
        $searchForm = $this->createForm(SearchType::class, $searchObj);

        $searchForm->handleRequest($request);
        if($searchForm->isSubmitted() && $searchForm->isValid()) {
            $searchObj = $searchForm->getData();
            $resultSearch = $this->produitStoreRepository->findByNameStoreLike($searchObj['nom']);
            if(count($resultSearch))
                $storeProducts = $resultSearch;
            else
                $msg = "Aucun magasin trouvé avec le nom cherché";
        }

        return $this->render('main/home.html.twig', [
            'msg' => $msg,
            'storeProducts' => $storeProducts,
            'typeproduits' => $this->typeProduits,
            'searchForm' => $searchForm->createView()
        ]);
    }


    /**
     * @Route("/les_produits_du_magasin/{store_id}|{product_id}", name="showProductStoreSearch")
     */
    public function afficherProduitMagasin(int $store_id, int $product_id, PanierService $panierService){
        $this->products = $this->produitRepository->findOneBy(["id" => $product_id, "store" => $store_id, "isdefault" => true]);
        $cart = $panierService->getProduit();


        return $this->render('main/home.html.twig', [
            'products' => $this->products
        ]);
    }

    /**
     * @Route("/ajout_panier/{store_id}|{product_id}", name="addProductCart")
     */
    public function ajouterProduitPanier(int $product_id, int $store_id,PanierService $panierService){
        $panierService->addProduct($product_id);

        return $this->redirectToRoute('showProduct', ['product_id' => $product_id]);
    }

    /**
     * @Route("/panier", name="showProductCart")
     */
    public function afficherProduitPanier(PanierService $panierService){
        $cart = $panierService->getProduit();
        //TODO redirect to cart page
        return $this->render('panier/show.html.twig',
            ['cart' => $cart]);
    }

    /**
     * @Route("/panier/supprimer/{product_id}", name="deleteProductCart")
     */

    public function supprimerProduitPanier(int $product_id, PanierService $panierService){
        $panierService->deleteProduct($product_id, $panierService->DELETEONE);
        $cart = $panierService->getProduit();
        //TODO redirect to cart page
        return $this->redirectToRoute('showProductCart');
    }

    /**
     * @Route("/panier/supprimer_tout/{product_id}", name="deleteAllProductCart")
     */

    public function supprimerTousProduitPanier(int $product_id, PanierService $panierService){
        $cart = $panierService->deleteProduct($product_id, $panierService->DELETEALL);
        //TODO redirect to cart page
        return $this->redirectToRoute('showProductCart');
    }

    /**
     * @Route("/panier/supprimer_tout", name="deleteAllCart")
     */
    public function supprimerPanier(PanierService $panierService){
        $cart = $panierService->deleteProduct(null, $panierService->DELETECART);
        //TODO redirect to cart page
        return $this->redirectToRoute('showProductCart');
    }

    /**
     * @Route("/panier/payer", name="validateCart")
     */
    public function validerPanier(PanierService $panierService){
        //$cart = $panierService->deleteProduct(null, $panierService->DELETECART);
        //TODO redirect to cart page
        return $this->redirectToRoute('showProductCart');
    }





    /**
     * @Route("/mentionsLegales", name="mentionsLegales")
     */
    public function mentionsLegales(){
    return $this->render('main/mention_legales.html.twig');
    }
}
