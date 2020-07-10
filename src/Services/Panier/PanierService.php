<?php


namespace App\Services\Panier;


use App\Repository\ProduitRepository;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class PanierService
{
    protected $session;
    protected $produitRepository;

    public function __construct(SessionInterface $session, ProduitRepository $produitRepository)
    {
        $this->session = $session;
        $this->produitRepository = $produitRepository;
    }

    public function addProduct(int $id){
        $cart = $this->session->get('cart', []);
        if(!empty($cart[$id])){
            $quantity = $cart[$id]['quantity'];
            $cart[$id]['quantity'] = $quantity + 1;
        }else{
            $cart[$id] = [
                "product" => $this->produitRepository->find($id),
                'quantity' => 1
            ];
        }
        $this->session->set('cart', $cart);
    }

    public function getProduit(){
        $cart = $this->session->get('cart', []);
        return $cart;
    }


}