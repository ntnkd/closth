<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    public function add(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] += 1;
        } else {
            $cart[$id] = [
                'name' => $product->name,
                'price' => $product->price,
                'thumb' => $product->thumb,
                'quantity' => 1
            ];
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Product has been added to the cart!');
    }

    public function index()
    {
        $cart = session('cart', []);
        return view('cart', compact('cart'));
    }

    public function update(Request $request)
    {
        $cart = session()->get('cart', []);

        foreach ($request->quantity as $id => $qty) {
            if (isset($cart[$id])) {
                $cart[$id]['quantity'] = (int)$qty;
            }
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Shopping cart updated successfully!');
    }

    public function delete($id)
    {
        $cart = session()->get('cart', []);
        unset($cart[$id]);
        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Product has been removed from the cart!');
    }
}

