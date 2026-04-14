<div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 mb-4">
    <div class="product-card">
        @if($product->discount_percent > 0)
            <span class="badge-sale">-{{ $product->discount_percent }}%</span>
        @endif
        @if($product->is_new)
            <span class="badge-new">NEW</span>
        @endif

        <a href="{{ route('products.show', $product->slug) }}" class="product-img-wrap">
            <img src="{{ $product->image ?: 'https://placehold.co/400x300?text=Laptop' }}"
                 onerror="this.src='https://placehold.co/400x300?text=Laptop'"
                 alt="{{ $product->name }}">
        </a>

        <div class="product-body">
            <h6 class="product-title">
                <a href="{{ route('products.show', $product->slug) }}">
                    {{ Str::limit($product->name, 48) }}
                </a>
            </h6>
            <div class="product-specs">
                <div><i class="bi bi-cpu"></i>{{ Str::limit($product->cpu, 28) }}</div>
                <div><i class="bi bi-memory"></i>{{ $product->ram }} • {{ $product->storage }}</div>
            </div>
            <div class="mb-2">
                <span class="price">{{ number_format($product->display_price) }}₫</span>
                @if($product->sale_price)
                    <span class="price-old">{{ number_format($product->price) }}₫</span>
                @endif
            </div>
            <form action="{{ route('cart.add', $product->id) }}" method="POST">
                @csrf
                <button class="btn-cart" {{ $product->stock <= 0 ? 'disabled' : '' }}>
                    <i class="bi bi-cart-plus"></i> {{ $product->stock > 0 ? 'Thêm vào giỏ' : 'Hết hàng' }}
                </button>
            </form>
        </div>
    </div>
</div>
