@extends('layout')

@section('title')
Catalog
@endsection()

@section('content')

<div class="catalog">
    <img src="{{ asset('images/catalogImages/back1.jpg') }}" alt="">
    <div class="catalog-items row">
        <?php
        foreach ($categories as $category) {
            echo '<a class="col-sm-12 col-md-4" href="/catalog/', $category->id, '/', $category->url, '"><img src="', asset("images/catalogImages/$category->img"), '" alt="', $category->name, '" /><span>', $category->name, '</span></a>';
        }
        ?>
    </div>
</div>

@endsection()