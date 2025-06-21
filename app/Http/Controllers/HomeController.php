<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Slider;

class HomeController extends Controller
{
    public function adminIndex(){

        $sliders = Slider::where('active', 1)->get();
        $products = Product::where('active', 1)->get();

        return view('admin.home', [
            'title' => 'dashboard',
            'sliders' => $sliders,
            'products' => $products,
        ]);
    }

    public function index(){
        $sliders = Slider::where('active', 1)->get();
        $products = Product::where('active', 1)->get();

        return view('index', [
            'title' => 'dashboard',
            'sliders' => $sliders,
            'products' => $products,
        ]);
    }

    public function shop(){

        $products = Product::where('active', 1)->get();

        return view('shop', [
            'title' => 'shop',
            'products' => $products,
        ]);
    }

    public function productDetail($id){
        $product = Product::findOrFail($id);

        return view('productDetail', [
            'title' => $product->name,
            'product' => $product,
        ]);
    }

    public function cart(){
        return view('cart', [
            'title' => 'cart',
        ]);
    }

    public function category($id)
    {
        $category = Category::findOrFail($id);
        $products = $category->products()->where('active', 1)->get();

        $categories = Category::all();

        return view('shop', [
            'title' => $category->name,
            'products' => $products,
            'categories' => $categories
        ]);
    }

    public function contact(){
        return view('contact', [
            'title' => 'contact',
        ]);
    }

}
