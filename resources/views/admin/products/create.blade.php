@extends('layouts.admin')
@section('title', 'Thêm sản phẩm')
@section('page_title', 'Thêm sản phẩm mới')

@section('content')
<form action="{{ route('admin.products.store') }}" method="POST">
    @csrf
    @include('admin.products._form')
</form>
@endsection
