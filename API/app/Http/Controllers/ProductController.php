<?php namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use Config;
use App\Product;

class ProductController extends Controller {
    
   public function getAllProducts()
    {
        $products = Product::all();
       
        return $products;
    }
    
    
     public function getProduct(Request $request, $idCProduct)
    {
        $product = Product::find($idProduct);

        return $product;
    }

    /**
     * Create event.
     */
    public function createProduct(Request $request)
    {
        $product = new Product;
        $product->name = $request->input('name');
        $product->price = $request->input('price');
        $product->description = $request->input('description');
        $product->tax = $request->input('tax');
        $product->save();
    }
}