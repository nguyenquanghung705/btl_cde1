@extends('layouts.admin')
@section('title', 'Sửa sản phẩm')
@section('page_title', 'Cập nhật sản phẩm')

@section('content')
<form action="{{ route('admin.products.update', $product) }}" method="POST">
    @csrf @method('PUT')
    @include('admin.products._form')
</form>
@endsection
