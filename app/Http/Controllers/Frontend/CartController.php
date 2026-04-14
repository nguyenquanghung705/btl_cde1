<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = session('cart', []);
        $products = [];
        $total = 0;
        foreach ($cart as $id => $item) {
            $product = Product::find($id);
            if (!$product) continue;
            $price = $product->display_price;
            $subtotal = $price * $item['quantity'];
            $products[] = [
                'product' => $product,
                'quantity' => $item['quantity'],
                'price' => $price,
                'subtotal' => $subtotal,
            ];
            $total += $subtotal;
        }
        return view('frontend.cart', compact('products', 'total'));
    }

    public function add(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $cart = session('cart', []);
        $qty = max(1, (int) $request->input('quantity', 1));

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] += $qty;
        } else {
            $cart[$id] = ['quantity' => $qty];
        }
        session(['cart' => $cart]);
        return redirect()->route('cart.index')->with('success', 'Đã thêm "' . $product->name . '" vào giỏ hàng');
    }

    public function update(Request $request, $id)
    {
        $cart = session('cart', []);
        $qty = max(1, (int) $request->input('quantity', 1));
        if (isset($cart[$id])) {
            $cart[$id]['quantity'] = $qty;
            session(['cart' => $cart]);
        }
        return redirect()->route('cart.index');
    }

    public function remove($id)
    {
        $cart = session('cart', []);
        unset($cart[$id]);
        session(['cart' => $cart]);
        return redirect()->route('cart.index')->with('success', 'Đã xóa khỏi giỏ');
    }

    public function clear()
    {
        session()->forget('cart');
        return redirect()->route('cart.index');
    }
}
