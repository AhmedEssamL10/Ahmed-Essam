<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductsController extends Controller
{
    public function index()
    {
        //get all product
        $products = DB::table('products')->get();
        return view('products.index', compact('products')); // return view with this name
    }
    public function create()
    {
        //get all product
        $brands = DB::table('brands')->select('id', 'ar_name', 'en_name')->orderBy('en_name')->orderBy('id')->get();
        $subcatigories = DB::table('subcatigories')->select('id', 'ar_name', 'en_name')->orderBy('en_name')->orderBy('id')->get();
        return view('products.create', compact('brands', 'subcatigories')); // return view with this name
    }
    public function edit($id)
    {
        //get all product
        // dd($id);
        $product = DB::table('products')->where('id', '=', $id)->first(); // first() return the first object
        $brands = DB::table('brands')->select('id', 'ar_name', 'en_name')->orderBy('en_name')->orderBy('id')->get();
        $subcatigories = DB::table('subcatigories')->select('id', 'ar_name', 'en_name')->orderBy('en_name')->orderBy('id')->get();
        return view('products.edit', compact('product', 'brands', 'subcatigories')); // return view with this name
    }
    public function store(Request $request)
    {
        //validation
        $request->validate([
            'en_name' => ['required', 'max:32'],
            'ar_name' => ['required', 'max:32'],
            'price' => ['required', 'numeric'],
            'quantity' => ['nullable', 'integer'],
            'status' => ['nullable', 'in:0,1'],
            'code' => ['required', 'integer', 'unique:products,code'],
            'brands_id' => ['nullable', 'integer', 'exists:brands,id'],
            'subcatigories_id' => ['required', 'integer', 'exists:subcatigories,id'],
            'image' => ['required', 'max:1024', 'mimes:jpg,jpeg,png']

        ]);
        return view('products.edit', compact('product', 'brands', 'subcatigories'));
        //upload image
        // insert into db
        //redirect back with success massage

    }
    public function update(Request $request)
    {
        //get all product
        // dd($id);
        $request->validate([
            'en_name' => ['required', 'max:32'],
            'ar_name' => ['required', 'max:32'],
            'price' => ['required', 'numeric'],
            'quantity' => ['nullable', 'integer'],
            'status' => ['nullable', 'in:0,1'],
            'code' => ['required', 'integer', 'unique:products,code'],
            'brands_id' => ['nullable', 'integer', 'exists:brands,id'],
            'subcatigories_id' => ['required', 'integer', 'exists:subcatigories,id'],
            'image' => ['required', 'max:1024', 'mimes:jpg,jpeg,png']

        ]);
    }
}
