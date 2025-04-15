<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Darryldecode\Cart\Cart;
use Illuminate\Support\Facades\Auth;
class CartController extends Controller
{
    public function index(){
        \Cart::clear();
        $product = [
            'id' => 123,
            'name' => 'Example Product',
            'price' => 99.99,
            'quantity' => 2,
            'attributes' => [
                'size' => 'XL',
                'color' => 'blue',
                'image' => 'product-image.jpg'
            ],
            'associatedModel' => 'App\Models\Product'
        ];
        \Cart::add($product);
        $cartCount = \Cart::getContent()->count();
        $cartList = \Cart::getContent();
        $subTotal = \Cart::getSubTotal();
        $total= \Cart::getTotal();
        return view('cart.index',compact('cartList','subTotal','total', 'cartCount'));
    }

    public function store(){
        // 
    }

    public function add($produitID,$qte){
        $Produit = Produit::find($produitID);
        \Cart::add(array(
            'id' => $Produit->id,
            'name' => $Produit->designation,
            'price' => $Produit->prix_ht * (1+$Produit->tva/100),
            'quantity' => $qte,
            'attributes' => array(),
            'associatedModel' => $Produit
        ));
        return redirect()->back()->with('success','item has beed added to cart successfully');
    }

    public function update($produitID ,$qte){
        \Cart::update($produitID, array(
            'quantity' => $qte,
        ));
        return redirect()->back()->with('success','item has been updated successfully');
    }

    public function remove($produitID){
        \Cart::remove($produitID);
        return redirect()->back()->with('success','item has been removed successfully');
    }

    
    public function checkout(){
        if(\Cart::isEmpty()){
            return redirect()->back->with('error','cart is empty');
        }
        $ModesReglement = ModeReglement::all();
        $addresse = Auth::User->address();
        $total = \Cart::getTotal();
        return view('checkout',compact('total','ModesReglement','addresse'));
    }
    public function destroy()
    {
        \Cart::clear();
        return redirect()->back()->with('success', 'Cart has been cleared successfully');
    }
}
