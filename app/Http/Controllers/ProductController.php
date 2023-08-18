<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\ProductsApiTrait;
use App\Models\Product;


class ProductController extends Controller
{
    use ProductsApiTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $allProducts= $this->indexProducts();

        return $allProducts;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $storeProduct= $this->storeProduct($request);

        return $storeProduct;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $showProduct= $this->showProduct($id);

        return $showProduct;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,Product $product)
    {
        $updateProduct= $this->updateProduct($request,$product);

        return $updateProduct;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $deleteProduct= $this->destroyProduct($id);

        return $deleteProduct;
    }
}
