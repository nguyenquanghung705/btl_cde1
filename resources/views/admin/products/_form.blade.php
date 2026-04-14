@if($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
    </div>
@endif

<div class="row">
    <div class="col-md-8">
        <div class="card mb-3">
            <div class="card-header"><strong>Thông tin chung</strong></div>
            <div class="card-body">
                <div class="mb-3">
                    <label>Tên sản phẩm *</label>
                    <input name="name" class="form-control" required value="{{ old('name', $product->name ?? '') }}">
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Danh mục *</label>
                        <select name="category_id" class="form-select" required>
                            @foreach($categories as $c)
                                <option value="{{ $c->id }}" {{ old('category_id', $product->category_id ?? '') == $c->id ? 'selected' : '' }}>{{ $c->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Hãng *</label>
                        <select name="brand_id" class="form-select" required>
                            @foreach($brands as $b)
                                <option value="{{ $b->id }}" {{ old('brand_id', $product->brand_id ?? '') == $b->id ? 'selected' : '' }}>{{ $b->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="mb-3">
                    <label>Model</label>
                    <input name="model" class="form-control" value="{{ old('model', $product->model ?? '') }}">
                </div>
                <div class="mb-3">
                    <label>URL ảnh sản phẩm</label>
                    <input name="image" class="form-control" value="{{ old('image', $product->image ?? '') }}">
                </div>
                <div class="mb-3">
                    <label>Mô tả chi tiết</label>
                    <textarea name="description" class="form-control" rows="5">{{ old('description', $product->description ?? '') }}</textarea>
                </div>
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-header"><strong>Cấu hình</strong></div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3"><label>CPU</label><input name="cpu" class="form-control" value="{{ old('cpu', $product->cpu ?? '') }}"></div>
                    <div class="col-md-6 mb-3"><label>RAM</label><input name="ram" class="form-control" value="{{ old('ram', $product->ram ?? '') }}"></div>
                    <div class="col-md-6 mb-3"><label>Ổ cứng</label><input name="storage" class="form-control" value="{{ old('storage', $product->storage ?? '') }}"></div>
                    <div class="col-md-6 mb-3"><label>GPU</label><input name="gpu" class="form-control" value="{{ old('gpu', $product->gpu ?? '') }}"></div>
                    <div class="col-md-6 mb-3"><label>Màn hình</label><input name="screen" class="form-control" value="{{ old('screen', $product->screen ?? '') }}"></div>
                    <div class="col-md-6 mb-3"><label>OS</label><input name="os" class="form-control" value="{{ old('os', $product->os ?? '') }}"></div>
                    <div class="col-md-4 mb-3"><label>Cân nặng (kg)</label><input name="weight" type="number" step="0.01" class="form-control" value="{{ old('weight', $product->weight ?? '') }}"></div>
                    <div class="col-md-4 mb-3"><label>Pin</label><input name="battery" class="form-control" value="{{ old('battery', $product->battery ?? '') }}"></div>
                    <div class="col-md-4 mb-3"><label>Bảo hành</label><input name="warranty" class="form-control" value="{{ old('warranty', $product->warranty ?? '12 tháng') }}"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card mb-3">
            <div class="card-header"><strong>Giá & Tồn kho</strong></div>
            <div class="card-body">
                <div class="mb-3"><label>Giá gốc *</label><input name="price" type="number" class="form-control" required value="{{ old('price', $product->price ?? 0) }}"></div>
                <div class="mb-3"><label>Giá khuyến mãi</label><input name="sale_price" type="number" class="form-control" value="{{ old('sale_price', $product->sale_price ?? '') }}"></div>
                <div class="mb-3"><label>Tồn kho *</label><input name="stock" type="number" class="form-control" required value="{{ old('stock', $product->stock ?? 0) }}"></div>
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-header"><strong>Hiển thị</strong></div>
            <div class="card-body">
                <div class="form-check"><input name="is_featured" value="1" type="checkbox" class="form-check-input" {{ old('is_featured', $product->is_featured ?? 0) ? 'checked' : '' }}><label class="form-check-label">Sản phẩm nổi bật</label></div>
                <div class="form-check"><input name="is_new" value="1" type="checkbox" class="form-check-input" {{ old('is_new', $product->is_new ?? 0) ? 'checked' : '' }}><label class="form-check-label">Sản phẩm mới</label></div>
                <div class="form-check"><input name="status" value="1" type="checkbox" class="form-check-input" {{ old('status', $product->status ?? 1) ? 'checked' : '' }}><label class="form-check-label">Hoạt động</label></div>
            </div>
        </div>

        <button type="submit" class="btn btn-success btn-lg w-100"><i class="bi bi-check-circle"></i> Lưu</button>
        <a href="{{ route('admin.products.index') }}" class="btn btn-secondary w-100 mt-2">Hủy</a>
    </div>
</div>
