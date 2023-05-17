@extends('layout')

@section('content')
<?php
foreach ($users as $user) {
    echo $user->name;
}
?>
@endsection()