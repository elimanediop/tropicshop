<?php


namespace App\Services\Panier;


use App\Repository\ProduitRepository;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class PanierService
{
    protected $session;
    protected $produitRepository;
    public $DELETEONE = 1;
    public $DELETEALL = 2;
    public $DELETECART = 3;

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

    /**
     * typeDeleting can take value: 1- delete one, 2- delete all products with id, 3- delete all cart
     * @param int $id
     * @param $typeDeleting
     */

    public function deleteProduct($id, $typeDeleting){
        $cart = $this->session->get('cart', []);

        if(!empty($cart[$id])){
            switch ($typeDeleting){
                case $this->DELETEONE:
                    $this->delete($cart, $id);break;
                case $this->DELETEALL:
                    unset($cart[$id]);break;
                case $this->DELETECART:
                    $cart= [];break;
            }
        }
        $this->session->set('cart', $cart);
    }

    private function delete($cart, $id): array {
        if(!empty($cart[$id])){
            $quantity = $cart[$id]['quantity'];
            if($quantity > 1){
                $cart[$id]['quantity'] = $quantity - 1;
            }else{
                unset($cart[$id]);
            }
        }
        return $cart;
    }

    public function getProduit(){
        $cart = $this->session->get('cart', []);
        return $cart;
    }


}