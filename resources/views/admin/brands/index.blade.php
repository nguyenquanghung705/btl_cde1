@extends('layouts.admin')
@section('title', 'Hãng')
@section('page_title', 'Quản lý hãng sản xuất')

@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header"><strong>Thêm hãng</strong></div>
            <div class="card-body">
                <form action="{{ route('admin.brands.store') }}" method="POST">
                    @csrf
                    <div class="mb-3"><label>Tên *</label><input name="name" class="form-control" required></div>
                    <div class="mb-3"><label>Logo URL</label><input name="logo" class="form-control"></div>
                    <div class="mb-3"><label>Mô tả</label><textarea name="description" class="form-control"></textarea></div>
                    <button class="btn btn-success w-100"><i class="bi bi-plus"></i> Thêm</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-header"><strong>Danh sách</strong></div>
            <div class="card-body p-0">
                <table class="table mb-0">
                    <thead class="table-light"><tr><th>ID</th><th>Tên</th><th>Số sản phẩm</th><th></th></tr></thead>
                    <tbody>
                        @foreach($brands as $b)
                            <tr>
                                <td>{{ $b->id }}</td>
                                <td>{{ $b->name }}</td>
                                <td>{{ $b->products()->count() }}</td>
                                <td>
                                    <form action="{{ route('admin.brands.destroy', $b) }}" method="POST" class="d-inline" onsubmit="return confirm('Xóa?')">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
