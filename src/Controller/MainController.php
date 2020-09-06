<?php

namespace App\Controller;

use App\Repository\ProduitRepository;
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
    private $types_produits = [
        "fruits" => 1,
        "comestiques" => 2,
        "legumes" => 3,
        "condiments-epices" => 4,
        "autre" => 5

    ];

    public function __construct(ProduitRepository $produitRepository, UserRepository $userRepository)
    {
        $this->produitRepository = $produitRepository;
        $this->userRepository = $userRepository;

    }

    /**
     * @Route("/", name="home")
     */
    public function index()
    {
        $this->products = $this->produitRepository->findBy(["isdefault" => true]);
        return $this->render('main/home.html.twig', [
            'products' =>$this->products
        ]);
    }

    /**
     * @Route("/produit/{id}", name="showProduct")
     */
    public function afficherProduitDetail(int $id)
    {
        $product = $this->produitRepository->find($id);
        return $this->render('main/show_product.html.twig', [
            'product' =>$product
        ]);
    }

    /**
     * @Route("/filter_category/{category}", name="filter_category")
     */
    public function filter(string $category){
        $error = "";
        $id_category = isset($this->types_produits[$category])? $this->types_produits[$category] : null;
        if($id_category){
            $this->products = $this->produitRepository->findByTypeproduit($id_category, true);
            return $this->render('main/home.html.twig', [
                'products' =>$this->products,

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
     * @Route("/les_produits_du_magasin/{store_id}|{product_id}", name="showProductStoreSearch")
     */
    public function afficherProduitMagasin(int $store_id, int $product_id, PanierService $panierService){
        $this->products = $this->produitRepository->findOneByUserId($product_id, $store_id);
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

        return $this->redirectToRoute('showProductStoreSearch', ['store_id' => $store_id, 'product_id' => $product_id]);
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
     * @Route("/mentionsLegales", name="mentionsLegales")
     */
    public function mentionsLegales(){
    return $this->render('main/mention_legales.html.twig');
    }
}
