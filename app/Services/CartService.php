<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Collection;

class CartService
{
    const SESSION_KEY = 'cart';

    public function all(): array
    {
        return session(self::SESSION_KEY, []);
    }

    public function count(): int
    {
        return count($this->all());
    }

    public function add(int $productId, int $quantity = 1): void
    {
        $cart = $this->all();
        $quantity = max(1, $quantity);

        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] += $quantity;
        } else {
            $cart[$productId] = ['quantity' => $quantity];
        }

        $this->save($cart);
    }

    public function update(int $productId, int $quantity): void
    {
        $cart = $this->all();
        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] = max(1, $quantity);
            $this->save($cart);
        }
    }

    public function remove(int $productId): void
    {
        $cart = $this->all();
        unset($cart[$productId]);
        $this->save($cart);
    }

    public function clear(): void
    {
        session()->forget(self::SESSION_KEY);
    }

    public function isEmpty(): bool
    {
        return empty($this->all());
    }

    /**
     * Return resolved cart lines with live product data + totals.
     *
     * @return array{lines: Collection, total: int}
     */
    public function summary(): array
    {
        $cart = $this->all();
        if (empty($cart)) {
            return ['lines' => collect(), 'total' => 0];
        }

        $products = Product::whereIn('id', array_keys($cart))->get()->keyBy('id');

        $lines = collect();
        $total = 0;

        foreach ($cart as $productId => $item) {
            $product = $products->get($productId);
            if (!$product) {
                continue;
            }
            $price = $product->display_price;
            $subtotal = $price * $item['quantity'];
            $lines->push([
                'product' => $product,
                'quantity' => $item['quantity'],
                'price' => $price,
                'subtotal' => $subtotal,
            ]);
            $total += $subtotal;
        }

        return ['lines' => $lines, 'total' => $total];
    }

    protected function save(array $cart): void
    {
        session([self::SESSION_KEY => $cart]);
    }
}
