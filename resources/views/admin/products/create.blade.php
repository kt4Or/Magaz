@extends('layouts.layout')

@section('title')@parent :: Добавить товар@endsection

@section('content')
    <div class="col-md-12">
        <h1>Добавить товар</h1>

        <form action="{{ route('admin.products.store') }}" method="post" enctype="multipart/form-data">
            @include('admin.products._form')
        </form>
    </div>
@endsection
