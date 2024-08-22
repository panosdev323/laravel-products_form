<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('products', compact('products'));
    }
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'productName' => 'required|string|max:255',
            'quantityStock' => 'required|integer',
            'itemPrice' => 'required|numeric',
        ]);

        // Create a new product record
        Product::create([
            'product_name' => $validated['productName'],
            'quantity_stock' => $validated['quantityStock'],
            'item_price' => $validated['itemPrice']
        ]);

        // Return a JSON response
        $products = Product::all();
        return response()->json([
            'success' => 'Product added successfully!',
            'products' => $products
        ]);    }
}