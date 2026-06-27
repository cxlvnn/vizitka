<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class CartController extends Controller
{
    public function index(Request $request): Response
    {
        $cart = $request->session()->get('cart', []);
        $productIds = array_keys($cart);

        $products = Product::whereIn('id', $productIds)->get()->map(function ($product) use ($cart) {
            $product->quantity = $cart[$product->id] ?? 1;

            return $product;
        });

        $total = $products->sum(fn ($product) => $product->price * $product->quantity);

        return Inertia::render('Cart', [
            'cartItems' => $products,
            'total' => $total,
        ]);
    }

    public function add(Request $request): RedirectResponse
    {
        $request->validate([
            'product_id' => ['required', 'exists:products,id'],
            'quantity' => ['required', 'integer', 'min:1'],
        ]);

        $cart = $request->session()->get('cart', []);
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity', 1);

        $cart[$productId] = ($cart[$productId] ?? 0) + $quantity;
        $request->session()->put('cart', $cart);

        return back()->with('success', __('Added to cart'));
    }

    public function update(Request $request): RedirectResponse
    {
        $request->validate([
            'product_id' => ['required', 'exists:products,id'],
            'quantity' => ['required', 'integer', 'min:1'],
        ]);

        $cart = $request->session()->get('cart', []);
        $cart[$request->input('product_id')] = $request->input('quantity');
        $request->session()->put('cart', $cart);

        return back();
    }

    public function remove(Request $request): RedirectResponse
    {
        $request->validate([
            'product_id' => ['required', 'exists:products,id'],
        ]);

        $cart = $request->session()->get('cart', []);
        unset($cart[$request->input('product_id')]);
        $request->session()->put('cart', $cart);

        return back();
    }

    public function clear(Request $request): RedirectResponse
    {
        $request->session()->forget('cart');

        return back();
    }
}
