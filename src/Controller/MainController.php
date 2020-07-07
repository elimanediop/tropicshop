<?php

namespace App\Controller;

use App\Repository\ProduitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    private $products;
    private $types_produits = [
        "fruits" => 1,
        "comestiques" => 2,
        "legumes" => 3,
        "condiments-epices" => 4,
        "autre" => 5

    ];
    /**
     * @Route("/", name="home")
     */
    public function index(Request $request, ProduitRepository $produitRepository)
    {
        $this->products = $produitRepository->findAll();
        return $this->render('main/home.html.twig', [
            'products' =>$this->products
        ]);
    }

    /**
     * @Route("/filter_category/{category}", name="filter_category")
     */
    public function filter(Request $request, string $category,ProduitRepository $produitRepository){
        $location = $request->get('top-map');
        $term = $request->get('top-search');
        $id_category = $this->types_produits[$category];

        $this->products = $produitRepository->findByTypeproduit($id_category);
        return $this->render('main/home.html.twig', [
            'products' =>$this->products
        ]);
    }

    /**
     * @Route("/recherche", name="search")
     */
    public function search(Request $request, ProduitRepository $produitRepository){

        $location = $request->get('top-map');
        $term = $request->get('top-search');
        $storeProducts=[];

        if(strlen($term) && strlen($location)){
            $storeProducts = $produitRepository->findByTerm($term);
            exit();
        }elseif (strlen($location)){
            //$this->products = $produitRepository->findByTerm($term);
        }elseif (strlen($term)){
            $storeProducts = $produitRepository->findByTerm($term);

        }else{
            $this->products = $produitRepository->findAll();
        }

        return $this->render('main/home.html.twig', [
            'products' =>$this->products,
            'storeProducts' => $storeProducts,
            'searchTerm' => $term,
            'location' => $location
        ]);
    }




    /**
     * @Route("/mentionsLegales", name="mentionsLegales")
     */
    public function mentionsLegales(){
    return $this->render('main/mention_legales.html.twig');
    }
}
