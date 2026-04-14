<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Giỏ hàng đang trống');
        }
        $products = [];
        $total = 0;
        foreach ($cart as $id => $item) {
            $p = Product::find($id);
            if (!$p) continue;
            $sub = $p->display_price * $item['quantity'];
            $products[] = ['product' => $p, 'quantity' => $item['quantity'], 'subtotal' => $sub];
            $total += $sub;
        }
        return view('frontend.checkout', compact('products', 'total'));
    }

    public function placeOrder(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:100',
            'customer_phone' => 'required|string|max:20',
            'customer_email' => 'required|email|max:150',
            'shipping_address' => 'required|string',
            'payment_method' => 'required|in:cod,vnpay,momo,bank_transfer',
        ]);

        $cart = session('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Giỏ hàng đang trống');
        }

        DB::beginTransaction();
        try {
            $total = 0;
            $items = [];
            foreach ($cart as $id => $item) {
                $p = Product::find($id);
                if (!$p) continue;
                $price = $p->display_price;
                $sub = $price * $item['quantity'];
                $items[] = [
                    'product_id' => $p->id,
                    'product_name' => $p->name,
                    'price' => $price,
                    'quantity' => $item['quantity'],
                    'subtotal' => $sub,
                ];
                $total += $sub;
            }

            $shippingFee = $total >= 20000000 ? 0 : 50000;

            $order = Order::create([
                'order_code' => 'ORD' . date('Ymd') . str_pad(Order::count() + 1, 4, '0', STR_PAD_LEFT),
                'user_id' => auth()->id(),
                'customer_name' => $request->customer_name,
                'customer_phone' => $request->customer_phone,
                'customer_email' => $request->customer_email,
                'shipping_address' => $request->shipping_address,
                'total_amount' => $total,
                'discount' => 0,
                'shipping_fee' => $shippingFee,
                'final_amount' => $total + $shippingFee,
                'payment_method' => $request->payment_method,
                'note' => $request->note,
            ]);

            foreach ($items as $item) {
                $item['order_id'] = $order->id;
                OrderItem::create($item);
                Product::where('id', $item['product_id'])->decrement('stock', $item['quantity']);
            }

            session()->forget('cart');
            DB::commit();

            return redirect()->route('checkout.success', $order->id);
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Có lỗi: ' . $e->getMessage());
        }
    }

    public function success($id)
    {
        $order = Order::with('items')->findOrFail($id);
        return view('frontend.checkout_success', compact('order'));
    }
}
