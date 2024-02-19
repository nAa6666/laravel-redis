<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class IndexController extends Controller
{
    public function index(Request $request)
    {
        $page = $request->page ?? 1;
        $products = Cache::remember('products_paginate_'.$page, 60, function () {
            return Product::paginate(15);
        });
        return view('index', compact('products'));
    }
}
