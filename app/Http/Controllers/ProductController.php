<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{ 
    public function index(Request $request)
    {
        $query = $request->input('search');
        $products = Product::when($query, function ($queryBuilder) use ($query) {
            return $queryBuilder->where('name', 'like', "%{$query}%");
        })->paginate(10);
    
        // If this is an AJAX request, return the table rows only
        if ($request->ajax()) {
            return view('product.partials.table', ['products' => $products]);
        }
    
        return view('product.index', ['products' => $products]);
    }
    
    public function create()
    {
        return view('product.create');

    }
    public function store(Request $request){
        $data = $request->validate([
            'name'=> 'required',
            'price' => 'required|numeric',
            'qty'=> 'required|integer',
            'description' => 'nullable|string|max:500'
        ]);

        $newProduct = Product::create($data);
        return redirect()->route('product.index')->with('success','');
    }
    public function edit(Product $product){
        return view('product.edit' , ['product'=> $product]);
    }
    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'name'=> 'required',
            'price' => 'required|numeric',
            'qty'=> 'required|integer',
            'description' => 'nullable|string|max:500'
        ]);

        $product->update($data);

        return redirect()->route('product.index')->with('success','Product Updated Successfully');
    }
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('product.index')->with('success','Deleted Successfully');
    }

}
