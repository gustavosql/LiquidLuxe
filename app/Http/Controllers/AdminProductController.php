<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;

class AdminProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('admin.products', compact('products'));
    }


    //Mostrar view de editar
    public function edit()
    {
        return view('admin.product_edit');
    }


    //Recebe requisição para update - PUT
    public function update()
    {
    }

    //Mostrar view de criar
    public function create()
    {
        return view('admin.product_create');
    }

    //Recebe requisição de criar - POST
    public function store(Request $request)
    {
        $input = $request->validate([
            'name' => 'string|required',
            'price' => 'string|required',
            'stock' => 'integer|nullable',
            'cover' => 'file|nullable',
            'description' => 'string|nullable',

        ]);


        $input['slug'] = Str::slug($input['name']);

        if (!empty($input['cover']) && $input['cover']->isValid()) {

            $file = $input['cover'];
            $path = $file->store('public/products');
            $input['cover'] = $path;
        }

        Product::create($input);

        return Redirect::route('admin.product');
    }
}
