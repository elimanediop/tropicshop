<?php

namespace App\Controller;

use App\Repository\ProduitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    private $products;

    protected $request;
    protected $produitRepository;
    protected $session;
    private $types_produits = [
        "fruits" => 1,
        "comestiques" => 2,
        "legumes" => 3,
        "condiments-epices" => 4,
        "autre" => 5

    ];

    public function __construct(ProduitRepository $produitRepository)
    {
        $this->produitRepository = $produitRepository;
    }

    /**
     * @Route("/", name="home")
     */
    public function index()
    {
        $this->products = $this->produitRepository->findAll();
        return $this->render('main/home.html.twig', [
            'products' =>$this->products,
            'location' => "",
            "storeProducts" => []

        ]);
    }

    /**
     * @Route("/filter_category/{category}", name="filter_category")
     */
    public function filter(string $category){
        $location = $this->request->get('top-map');
        $term = $this->request->get('top-search');
        $id_category = $this->types_produits[$category];

        $this->products = $this->produitRepository->findByTypeproduit($id_category);
        return $this->render('main/home.html.twig', [
            'products' =>$this->products,
            'location' => "",
            "storeProducts" => []
        ]);
    }

    /**
     * @Route("/recherche", name="search")
     */
    public function search(){

        $location = $this->request->get('top-map');
        $term = $this->request->get('top-search');
        $storeProducts=[];

        if(strlen($term) && strlen($location)){
            $storeProducts = $this->produitRepository->findByTerm($term);
        }elseif (strlen($location)){
            //$this->products = $this->produitRepository->findByTerm($term);
        }elseif (strlen($term)){
            $storeProducts = $this->produitRepository->findByTerm($term);
        }else{
            $this->products = $this->produitRepository->findAll();
        }

        return $this->render('main/home.html.twig', [
            'products' =>$this->products,
            'storeProducts' => $storeProducts,
            'searchTerm' => $term,
            'location' => $location
        ]);
    }


    /**
     * @Route("/les_produits_du_magasin/{store_id}|{product_id}", name="showProductStoreSearch")
     */
    public function afficherProduitMagasin(int $store_id, int $product_id){
        $this->products = $this->produitRepository->findOneByUserId($product_id, $store_id);

        return $this->render('main/home.html.twig', [
            'products' => $this->products
        ]);
    }



    /**
     * @Route("/mentionsLegales", name="mentionsLegales")
     */
    public function mentionsLegales(){
    return $this->render('main/mention_legales.html.twig');
    }
}
