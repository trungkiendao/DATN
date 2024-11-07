<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function clientProducts(){
        // Tìm sản phẩm theo ID
        $products = Product::all();

        // Trả về view 'product.show' với dữ liệu sản phẩm
        return view('client.clientProducts', compact('products'));
   }
    public function clientProductDetail($id){
         // Tìm sản phẩm theo ID
         $product = Product::findOrFail($id);

         // Trả về view 'product.show' với dữ liệu sản phẩm
         return view('client.clientProductDetail', compact('product'));
    }
}
