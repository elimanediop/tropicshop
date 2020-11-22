<?php

namespace App\Controller;

use App\Entity\HistoriqueStock;
use App\Entity\Origine;
use App\Entity\ProduitStore;
use App\Entity\Stock;
use App\Entity\StockUpdate;
use App\Form\ProduitStoreType;
use App\Form\SearchType;
use App\Form\StockType;
use App\Repository\HistoriqueStockRepository;
use App\Repository\OrigineRepository;
use App\Repository\ProduitRepository;
use App\Repository\ProduitStoreRepository;
use App\Repository\StockRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
    private $stockRepository;
    private $historyRepository;

    public function __construct(ObjectManager $manager, ProduitStoreRepository $produitStoreRepository,
                                ProduitRepository $produitRepository, OrigineRepository $origineRepository,
                                StockRepository $stockRepository, HistoriqueStockRepository $historyRepository)
    {
        $this->manager = $manager;
        $this->produitStoreRepository = $produitStoreRepository;
        $this->produitRepository = $produitRepository;
        $this->origieRepository = $origineRepository;
        $this->stockRepository = $stockRepository;
        $this->historyRepository = $historyRepository;
    }
    /**
     * @Route("/store", name="store_profil")
     */
    public function index(Request $request)
    {
        $products = $this->produitStoreRepository->findBy(["store"=> $this->getUser()]);
        $stocks = $this->stockRepository->arrayAssocKeyProduitStoreStock($this->getUser()->getId());

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
            'searchForm' => $searchForm->createView(),
            'stocks' => $stocks
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
        //TODO on adding check product if exists and different origin
        $produitStore = new ProduitStore();
        $produit = $this->produitRepository->find($product_id);
        $produitStore->setProduit($produit);

        $form = $this->createForm(ProduitStoreType::class, $produitStore);
        $form->handleRequest($request);
        $error = "";

        $stock = new Stock();
        $stock->setProduitStore($produitStore);
        $history = $this->historyRepository->findOneBy(["stock" => $stock]);
        if(!$history){
            $history = new HistoriqueStock();
            $history->setStock($stock);
        }
        $stockForm = $this->createForm(StockType::class, $stock);

        $stockForm->handleRequest($request);

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
            $this->save($stock);
            $stockUpdate = new StockUpdate($stock->getQuantity()?$stock->getQuantity():0);
            $history->setDateUpdate($stockUpdate);
            $this->save($history);
            return $this->redirectToRoute("store_profil");

            //$error = "Apparemment vous avez déjà ce produit dans votre store ou le prix saisi est 0.";

        }

        //$this->previewProduct = $produit;

        return $this->render("components/store/edit_product_for_store.html.twig", [
            "form" => $form->createView(),
            'stockForm' => $stockForm->createView(),
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
        $produitsStore = $this->produitStoreRepository->findBy(["store" => $this->getUser()]);
        $searchObj = ["nom" => null];
        $msg = "";
        $stocks = $this->stockRepository->arrayAssocKeyProduitStoreStock($this->getUser()->getId());
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

        return $this->render('components/store/select_edit_produit.html.twig', [
            'title' => $this->title_delete_produit,
            'productsStore' => $produitsStore,
            "msg" => $msg,
            'stocks' => $stocks,
            'searchForm' => $searchForm->createView()
        ]);
    }
    /**
     * @Route("/store/modifier_produit_store/{product_id}", name="edit_product_store")
     */
    public function editProduitFromStore(Request $request, string $product_id){

        $error = "";
        if(is_null($product_id)){
            return $this->redirectToRoute("store_profil", [
                'title' => $this->title_home
            ]);
        }
        $produitStore = $this->produitStoreRepository->find($product_id);
        $stockN = $this->stockRepository->findOneBy(["produitStore" => $product_id]);
        $stock = new Stock();
        $stock->setProduitStore($produitStore);
        if($stockN){
            $stock = $stockN;
        }
        $history = $this->historyRepository->findOneBy(["stock" => $stock]);
        if(!$history){
            $history = new HistoriqueStock();
            $history->setStock($stock);
        }
        $stockForm = $this->createForm(StockType::class, $stock);

        $stockForm->handleRequest($request);

        $form = $this->createForm(ProduitStoreType::class, $produitStore);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            if(is_null($produitStore->getOrigine())){
                $produitStore->setOrigine($produitStore->getOrigine());
            }else{
                /**
                 * @var Origine
                 */
                $origne = $produitStore->getOrigine();
                $produitStore->setOrigine($this->origieRepository->findOneBy(["country" => $origne->getCountry()]));
            }
            $stockUpdate = new StockUpdate($stock->getQuantity());
            $history->setDateUpdate($stockUpdate);
            $this->save($history);
            $this->save($stock);
            $this->save($produitStore);
            return $this->redirectToRoute("store_profil_edit_product");
        }



        return $this->render("components/store/edit_product_for_store.html.twig", [
            "form" => $form->createView(),
            'stockForm' => $stockForm->createView(),
            "error" => $error
        ]);
    }

    /**
     * @Route("/store/supprimer_produit", name="store_profil_delete_product")
     */
    public function deleteProduct(Request $request)
    {
        $produitsStore = $this->produitStoreRepository->findBy(["store" => $this->getUser()]);
        $stocks = $this->stockRepository->arrayAssocKeyProduitStoreStock($this->getUser()->getId());
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
            'stocks' => $stocks,
            'searchForm' => $searchForm->createView()
        ]);

    }

    /**
     * @Route("/store/supprimer_produit_store/{product_id}", name="deleteProductFromStore")
     */
    public function deleteProductFromStore(Request $request, string $product_id){
        $entityManager = $this->getDoctrine()->getManager();
        $produitStore = $this->produitStoreRepository->find($product_id);


        $stock = $this->stockRepository->findOneBy(["produitStore" => $product_id]);
        $history = $this->historyRepository->findOneBy(["stock" => $stock]);
        if($history){
            $entityManager->remove($history);
            $entityManager->flush();
        }
        if($stock){
            $entityManager->remove($stock);
            $entityManager->flush();
        }

        $entityManager->remove($produitStore);
        $entityManager->flush();
        return $this->redirectToRoute("store_profil_delete_product");

    }

    /**
     * @Route("/store/ajouter_stock_store", name="addStockStore")
     */
    public function addStockStore(Request $request){
        $produits = $this->produitStoreRepository->findBy(["store" => $this->getUser()]);
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

        return $this->render('components/stock/select_produit.html.twig', [
            'title' => $this->title_add_produit,
            'products' => $produits,
            "msg" => $msg,
            'searchForm' => $searchForm->createView()
        ]);
    }

    /**
     * @Route("/store/ajouter_quantite_en_stock_store/{product_id}", name="addQuantityStockStore")
     */
    public function addQuantityStockStore(Request $request, string $product_id){
        $productStore = $this->produitStoreRepository->findOneBy(["id" => $product_id]);
        $stockN = $this->stockRepository->findOneBy(["produitStore" => $product_id]);
        $stock = new Stock();
        $stock->setProduitStore($productStore);
        if($stockN){
            $stock = $stockN;
        }
        $history = $this->historyRepository->findOneBy(["stock" => $stock]);
        if(!$history){
            $history = new HistoriqueStock();
            $history->setStock($stock);
        }
        $stockForm = $this->createForm(StockType::class, $stock);
        $msg = "";
        $stockForm->handleRequest($request);
        if($stockForm->isSubmitted() && $stockForm->isValid()) {

            $stockUpdate = new StockUpdate($stock->getQuantity());
            $history->setDateUpdate($stockUpdate);
            $this->save($history);
            $this->save($stock);
            return $this->redirectToRoute("addStockStore");
        }
        return $this->render('components/stock/add_quantity.html.twig', [
            'title' => $this->title_add_produit,
            'product' => $productStore,
            "msg" => $msg,
            'history' => $history,
            'form' => $stockForm->createView()
        ]);

    }
}
