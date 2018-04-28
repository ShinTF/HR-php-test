<?php

namespace App\Http\Controllers\Products;

use Illuminate\Http\Request;

use App\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('vendor')->paginate(25);

        return view('products.index')->with('products', $products);
    }

    public function ajaxChangePrice(Request $request)
    {
        $product = Product::find($request['productID']);
        $product->price = $request['newPrice'];

        if($product->save()){
            return json_encode(['status' => 'success'], JSON_UNESCAPED_UNICODE);
        }
    }
}
