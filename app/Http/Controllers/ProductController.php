<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(){
        $title = 'Home Page';
        $products = Product::with(['category', 'status'])->orderBy('id', 'desc')->paginate(10);
        return view('products.index', compact('title', 'products'));

        return view('products.index');
            dd($slug);
            
            }
}
