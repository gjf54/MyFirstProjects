<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SeparatorCatalogProductController extends Controller
{
    public function start($selectedCatalogId, $selectedCatalogName)
    {
        $categories = DB::select('SELECT * FROM category WHERE parentCategory = ?', [$selectedCatalogId]);

        if (isset($categories[0])) {
            return view('catalog', ['categories' => $categories]);
        }


        $products = DB::select('SELECT * FROM product WHERE idCategory = ?', [$selectedCatalogId]);
        return view('porductsInCatalog', ['products' => $products]);
    }
    /*useless, create in catalog cntrl*/
}
