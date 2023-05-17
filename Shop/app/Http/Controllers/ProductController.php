<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function start($selectedProductId, $selectedProductName)
    {

        $product = DB::select('SELECT * FROM product WHERE id = ?', [$selectedProductId]);
        return view('product', ['product' => $product]);
    }
}
