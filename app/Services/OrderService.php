<?php

namespace App\Services;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class OrderService
{
    /** @var CartService */
    protected $cart;

    public function __construct(CartService $cart)
    {
        $this->cart = $cart;
    }

    const FREE_SHIPPING_THRESHOLD = 20000000;
    const SHIPPING_FEE = 50000;

    public function shippingFeeFor(int $total): int
    {
        return $total >= self::FREE_SHIPPING_THRESHOLD ? 0 : self::SHIPPING_FEE;
    }

    /**
     * Place an order atomically: decrement stock, create order + items, clear cart.
     */
    public function placeFromCart(array $customer): Order
    {
        return DB::transaction(function () use ($customer) {
            $summary = $this->cart->summary();
            $lines = $summary['lines'];

            if ($lines->isEmpty()) {
                throw new \RuntimeException('Giỏ hàng đang trống.');
            }

            $total = $summary['total'];
            $shippingFee = $this->shippingFeeFor($total);

            $order = Order::create([
                'order_code' => $this->generateOrderCode(),
                'user_id' => auth()->id(),
                'customer_name' => $customer['customer_name'],
                'customer_phone' => $customer['customer_phone'],
                'customer_email' => $customer['customer_email'],
                'shipping_address' => $customer['shipping_address'],
                'total_amount' => $total,
                'discount' => 0,
                'shipping_fee' => $shippingFee,
                'final_amount' => $total + $shippingFee,
                'payment_method' => $customer['payment_method'],
                'note' => $customer['note'] ?? null,
            ]);

            foreach ($lines as $line) {
                $product = $line['product'];
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'product_name' => $product->name,
                    'price' => $line['price'],
                    'quantity' => $line['quantity'],
                    'subtotal' => $line['subtotal'],
                ]);
                Product::whereKey($product->id)->decrement('stock', $line['quantity']);
            }

            $this->cart->clear();

            return $order;
        });
    }

    protected function generateOrderCode(): string
    {
        return 'ORD' . date('Ymd') . str_pad((string) (Order::count() + 1), 4, '0', STR_PAD_LEFT);
    }
}
