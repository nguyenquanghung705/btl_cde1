<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\AddToCartRequest;
use App\Http\Requests\Frontend\UpdateCartRequest;
use App\Models\Product;
use App\Services\CartService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CartController extends Controller
{
    /** @var CartService */
    protected $cart;

    public function __construct(CartService $cart)
    {
        $this->cart = $cart;
    }

    public function index(): View
    {
        $summary = $this->cart->summary();

        return view('frontend.cart', [
            'products' => $summary['lines'],
            'total' => $summary['total'],
        ]);
    }

    public function add(AddToCartRequest $request, Product $product): RedirectResponse
    {
        $this->cart->add($product->id, $request->quantity());

        return redirect()
            ->route('cart.index')
            ->with('success', 'Đã thêm "' . $product->name . '" vào giỏ hàng.');
    }

    public function update(UpdateCartRequest $request, Product $product): RedirectResponse
    {
        $this->cart->update($product->id, (int) $request->input('quantity'));

        return redirect()->route('cart.index');
    }

    public function remove(Product $product): RedirectResponse
    {
        $this->cart->remove($product->id);

        return redirect()->route('cart.index')->with('success', 'Đã xóa khỏi giỏ.');
    }

    public function clear(): RedirectResponse
    {
        $this->cart->clear();

        return redirect()->route('cart.index');
    }
}
