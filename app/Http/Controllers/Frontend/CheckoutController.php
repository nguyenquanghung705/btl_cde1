<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\PlaceOrderRequest;
use App\Models\Order;
use App\Services\CartService;
use App\Services\OrderService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CheckoutController extends Controller
{
    /** @var CartService */
    protected $cart;

    /** @var OrderService */
    protected $orders;

    public function __construct(CartService $cart, OrderService $orders)
    {
        $this->cart = $cart;
        $this->orders = $orders;
    }

    public function index()
    {
        if ($this->cart->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Giỏ hàng đang trống.');
        }

        $summary = $this->cart->summary();
        $shippingFee = $this->orders->shippingFeeFor($summary['total']);

        return view('frontend.checkout', [
            'products' => $summary['lines'],
            'total' => $summary['total'],
            'shippingFee' => $shippingFee,
            'finalAmount' => $summary['total'] + $shippingFee,
        ]);
    }

    public function placeOrder(PlaceOrderRequest $request): RedirectResponse
    {
        try {
            $order = $this->orders->placeFromCart($request->validated());
        } catch (\RuntimeException $e) {
            return redirect()->route('cart.index')->with('error', $e->getMessage());
        } catch (\Throwable $e) {
            return back()->with('error', 'Có lỗi xảy ra, vui lòng thử lại.')->withInput();
        }

        return redirect()->route('checkout.success', $order);
    }

    public function success(Order $order): View
    {
        $order->load('items');

        return view('frontend.checkout_success', compact('order'));
    }
}
