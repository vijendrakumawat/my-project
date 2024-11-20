<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Display list of products
    public function index()
    {
        $products = Product::all();
        return view('product.index', compact('products'));
    }

    // Show form to create a new product
    public function create()
    {
        return view('product.create');
    }

    // Store a newly created product
   // Store a newly created product
public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'required|string',
        'price' => 'required|numeric|min:0',
    ]);

    Product::create($validated);

    if ($request->ajax()) {
        return response()->json(['message' => 'Product added successfully!']);
        return redirect('/');
    }

    
}
public function edit($id)
{
    $product = Product::findOrFail($id);
    return view('product.edit', compact('product'));
}


// Update an existing product
public function update(Request $request, $id)
{
    
    $product = Product::findOrFail($id);
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'required|string',
        'price' => 'required|numeric|min:0',
    ]);

    $product->update($validated);

    if ($request->ajax()) {
        return response()->json(['message' => 'Product updated successfully!']);
        return redirect('/')->with('success', 'Product updated successfully!');
    }

    return redirect('/')->with('success', 'Product updated successfully!');
}

// Delete a product
public function destroy($id, Request $request)
{
    
  $dataproduct = Product::find($id);
  $dataproduct->delete($id);
    if ($request->ajax()) {
        return response()->json(['message' => 'Product deleted successfully!']);
    }

    return redirect('/')->with('success', 'Product deleted successfully!');
}

}

