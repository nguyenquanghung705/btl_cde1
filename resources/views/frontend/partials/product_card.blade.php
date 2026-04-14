<div class="col-md-3 col-sm-6 mb-4">
    <div class="card product-card position-relative">
        @if($product->discount_percent > 0)
            <span class="badge bg-danger badge-sale">-{{ $product->discount_percent }}%</span>
        @endif
        <a href="{{ route('products.show', $product->slug) }}">
            <img src="{{ $product->image ?: 'https://placehold.co/300x200?text=Laptop' }}"
                 onerror="this.src='https://placehold.co/300x200?text=Laptop'"
                 class="card-img-top product-img" alt="{{ $product->name }}">
        </a>
        <div class="card-body">
            <h6 class="card-title" style="min-height: 48px;">
                <a href="{{ route('products.show', $product->slug) }}" class="text-dark text-decoration-none">
                    {{ Str::limit($product->name, 50) }}
                </a>
            </h6>
            <small class="text-muted">{{ $product->cpu }}</small><br>
            <small class="text-muted">{{ $product->ram }} | {{ $product->storage }}</small>
            <div class="mt-2">
                <span class="price">{{ number_format($product->display_price) }}đ</span>
                @if($product->sale_price)
                    <br><span class="price-old">{{ number_format($product->price) }}đ</span>
                @endif
            </div>
            <form action="{{ route('cart.add', $product->id) }}" method="POST" class="mt-2">
                @csrf
                <button class="btn btn-sm btn-primary w-100">
                    <i class="bi bi-cart-plus"></i> Thêm vào giỏ
                </button>
            </form>
        </div>
    </div>
</div>
