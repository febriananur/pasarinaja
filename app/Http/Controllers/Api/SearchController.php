<?php
 
namespace App\Http\Controllers\Api;
 
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
 
class SearchController extends Controller
{
    public function index(Request $request)
    {
    $products = Product::latest()->when(request()->q, function($products) {
            $products = $products->where('title', 'like', '%'. request()->q . '%');
        })->get();
 
    return response()->json([
        'success'   => true,
        'message'   => 'Hasil Pencarian Produk',
        'products'    => $products
    ], 200);
    }  
}