<?php


namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\PanelProduct;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ProductRequest;
use App\Models\Scopes\AvailableScope;

// use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function index()
    {
        $products = PanelProduct::without('images')->get();
        return view('products.index')->with([
            'products' => $products
        ]);
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(ProductRequest $request)
    {

        $product = PanelProduct::create($request->validated());

        return redirect()
            ->route('products.index')
            ->withSuccess("New Product with ID no. {$product->id} was successfuly created");
    }

    public function show(PanelProduct $product)
    {
        // $products = Product::where('id', $product)->get();
        // $products = Product::where('id', $product)->first();
        // $products = Product::find($product);
        // $product = Product::findOrFail($product);
        return view('products.show')->with([
            'product' => $product,
        ]);
    }

    public function edit(PanelProduct $product)
    {
        // $product = Product::findOrFail($product);
        return view('products.edit')->with([
            'product' => $product
        ]);
    }

    public function update(ProductRequest $request, PanelProduct $product)
    {
        // $product = Product::findOrFail($product);
        $product->update($request->validated());
        return redirect()
            ->route('products.index')
            ->withSuccess("Product id no. {$product->id} was successfully updated");
    }

    public function destroy(PanelProduct $product)
    {
        // $product = Product::findOrFail($product);
        $product->delete();
        return redirect()
            ->route('products.index')
            ->withSuccess("Product no. {$product->id} was successfully removed");
    }
}
