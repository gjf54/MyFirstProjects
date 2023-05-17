<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CatalogController extends Controller
{
    public function start()
    {
        $categories = DB::select('SELECT * FROM category WHERE parentCategory = 0 ORDER BY numSort ASC');

        return view('catalog', ['categories' => $categories]);
    }
}
