<?php

namespace App\Controller;

use App\Entity\BonLivraison;
use App\Entity\Commande;
use App\Entity\TypeProduit;
use App\Form\BonLivraisonType;
use App\Form\PayementType;
use App\Form\SearchType;
use App\Repository\CommandeRepository;
use App\Repository\ProduitRepository;
use App\Repository\ProduitStoreRepository;
use App\Repository\TypeProduitRepository;
use App\Repository\UserRepository;
use App\Services\Panier\PanierService;
use Doctrine\Common\Persistence\ObjectManager;
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
    private $manager;
    private $commandeRepository;

    public function __construct(ObjectManager $manager, ProduitRepository $produitRepository,
                                UserRepository $userRepository, TypeProduitRepository $typeProduitRepository,
                                ProduitStoreRepository $produitStoreRepository, CommandeRepository $commandeRepository)
    {
        $this->produitRepository = $produitRepository;
        $this->userRepository = $userRepository;
        $this->typeProduitRepository = $typeProduitRepository;
        $this->typeProduits = $this->typeProduitRepository->findBy(
            array(),
            array('libelle' => 'ASC')
        );
        $this->produitStoreRepository = $produitStoreRepository;
        $this->manager = $manager;
        $this->commandeRepository = $commandeRepository;

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
            $storeProducts = $this->produitStoreRepository->findByNameLike($term);
        }else{
            $this->products = $this->produitRepository->findBy(["isdefault" => true]);
        }
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
            'products' =>$this->products,
            'storeProducts' => $storeProducts,
            'searchTerm' => $term,
            'location' => $location,
            'typeproduits' => $this->typeProduits,
            'lon' => $lon,
            'lat' => $lat,
            'searchForm' => $searchForm->createView()
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
     * @Route("/panier/bon_de_livraison", name="validateCart")
     */
    public function validerPanier(Request $request, PanierService $panierService){
        $cart = $panierService->getProduit();
        //TODO redirect to cart page
        $commande = new Commande();

        $commande->setStatus($commande->ATTENTE);
        $commande->setClient($this->getUser());
        $tab = [];
        foreach ($cart as $produitStoreCart){
            $tab[] = $produitStoreCart["product"];
        }
        $commande->setProduitStoreList($tab);
        $this->savePersist($commande);

        return $this->redirectToRoute("createBonLivraison", ["commande_id" => $commande->getId()]);
    }

    /**
     * @Route("/panier/bon_de_livraison/{commande_id}", name="createBonLivraison")
     */
    public function createBonLivraison(Request $request, int $commande_id, PanierService $panierService)
    {
        $commande = $this->commandeRepository->find($commande_id);
        $cart = $panierService->getProduit();
        $bonLivraison = new BonLivraison();
        $form = $this->createForm(BonLivraisonType::class, $bonLivraison);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $bonLivraison->setCommande($commande);
            $this->savePersist($bonLivraison);
            return $this->redirectToRoute("payementProcess",[
                'commande_id' =>$commande->getId(),
            ]);
        }
        return $this->render("components/commande/bon_livraison.html.twig",[
                'cart' => $cart,
                'commande' =>$commande,
                'form' => $form->createView()
            ]
        );
    }

    /**
     * @Route("/panier/paiement_commande/{commande_id}", name="payementProcess")
     */
    public function paiementCommande(Request $request, int $commande_id, PanierService $panierService)
    {
        $commande = $this->commandeRepository->find($commande_id);
        $cart = $panierService->getProduit();
        $paiement = [
            "nom" => null,
            'numero' => null,
            'cvc' => null,
            'expiration' => null];
        $form = $this->createForm(PayementType::class, $paiement);
        $form->handleRequest($request);
        $total = 0;
        foreach ($cart as $produitStoreCart){
            $total = $produitStoreCart["total_price"];
        }
        if($form->isSubmitted() && $form->isValid()) {
            //TODO submit
        }
        return $this->render('components/commande/show.html.twig',[
            'commande' => $commande,
            'cart' => $cart,
            'form' => $form->createView(),
            'total' => $total
        ]);
    }


    public function savePersist($entity){
        $this->manager->persist($entity);
        $this->manager->flush();
    }

    public function saveRemove($entity){
        $this->manager->remove($entity);
        $this->manager->flush();
    }




    /**
     * @Route("/mentionsLegales", name="mentionsLegales")
     */
    public function mentionsLegales(){
    return $this->render('main/mention_legales.html.twig');
    }
}
