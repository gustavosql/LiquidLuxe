<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductStoreRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('admin.products', compact('products'));
    }


    //Mostrar view de editar
    public function edit(Product $product)
    {
        return view('admin.product_edit', [
            'product' => $product
        ]);
    }


    //Recebe requisição para update - PUT
    public function update(Product $product, ProductStoreRequest $request)
    {
        $input = $request->validated();

        if (!empty($input['cover']) && $input['cover']->isValid()) {
            Storage::delete($product->cover ?? '');
            $file = $input['cover'];
            $path = $file->store('public/products');
            $input['cover'] = $path;
        }

        $product->fill($input);
        $product->save();
        return Redirect::route('admin.product');
    }

    //Mostrar view de criar
    public function create()
    {
        return view('admin.product_create');
    }

    //Recebe requisição de criar - POST
    public function store(ProductStoreRequest $request)
    {
        $input = $request->validated();


        $input['slug'] = Str::slug($input['name']);

        if (!empty($input['cover']) && $input['cover']->isValid()) {

            $file = $input['cover'];
            $path = $file->store('public/products');
            $input['cover'] = $path;
        }

        Product::create($input);

        return Redirect::route('admin.product');
    }


    public function destroy(Product $product)
    {
        $product->delete();
        Storage::delete($product->cover ?? '');
        return Redirect::route('admin.product');
    }
}
