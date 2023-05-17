@extends('layout')

@section('content')
<ul class="catalog-menu">
    <?php
    foreach ($products as $product) {
        echo '<li class="catalog-menu-item"><a href="/product/', $product->id, '/', $product->url, '">', $product->name, '</a></li>';
    }
    ?>
</ul>
@endsection()