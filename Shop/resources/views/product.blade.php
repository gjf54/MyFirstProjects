@extends('layout')

@section('content')
<?php
foreach ($product as $prod) {
?>
    <div class="prod-image col-sm-6">
        <img src="<? $prod->img ?>" />
    </div>
    <div class="prod-name col-sm-6">
        <span class="prod-name col-sm-6">
            <?php
            echo $prod->name;
            ?>
        </span>
    </div>
<?php
}
?>
@endsection()