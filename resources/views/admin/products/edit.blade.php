@extends('layouts.layout')

@section('title')@parent :: Редактировать товар@endsection

@section('content')
    <div class="col-md-12">
        <h1>Редактировать: {{ $product->title }}</h1>

        <form action="{{ route('admin.products.update', $product) }}" method="post" enctype="multipart/form-data">
            @include('admin.products._form')
        </form>
    </div>
@endsection
