<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {
        $data = Product::latest()->get();
        return view('frontend.home', compact('data'));
    }
}
