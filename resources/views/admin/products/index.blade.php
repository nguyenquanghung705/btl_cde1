@extends('layouts.admin')
@section('title', 'Sản phẩm')
@section('page_title', 'Quản lý sản phẩm')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between">
        <form class="d-flex" method="GET">
            <input name="keyword" class="form-control" placeholder="Tìm theo tên..." value="{{ request('keyword') }}">
            <button class="btn btn-primary ms-2">Tìm</button>
        </form>
        <a href="{{ route('admin.products.create') }}" class="btn btn-success">
            <i class="bi bi-plus-circle"></i> Thêm sản phẩm
        </a>
    </div>
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Ảnh</th>
                    <th>Tên sản phẩm</th>
                    <th>Hãng</th>
                    <th>Giá</th>
                    <th>Tồn kho</th>
                    <th>Trạng thái</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $p)
                    <tr>
                        <td>{{ $p->id }}</td>
                        <td><img src="{{ $p->image }}" onerror="this.src='https://placehold.co/50'" width="50"></td>
                        <td>
                            <strong>{{ $p->name }}</strong>
                            <br><small class="text-muted">{{ $p->cpu }} / {{ $p->ram }}</small>
                        </td>
                        <td>{{ $p->brand->name ?? '-' }}</td>
                        <td>{{ number_format($p->display_price) }}đ</td>
                        <td>{{ $p->stock }}</td>
                        <td>
                            @if($p->status)
                                <span class="badge bg-success">Hoạt động</span>
                            @else
                                <span class="badge bg-secondary">Ẩn</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.products.edit', $p) }}" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></a>
                            <form action="{{ route('admin.products.destroy', $p) }}" method="POST" class="d-inline" onsubmit="return confirm('Xóa sản phẩm này?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="8" class="text-center text-muted py-4">Chưa có sản phẩm</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="card-footer">{{ $products->links() }}</div>
</div>
@endsection
