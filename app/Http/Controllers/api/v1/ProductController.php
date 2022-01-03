<?php

namespace App\Http\Controllers\api\v1;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Services\ProductServices;
use App\Traits\ApiResponser;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;

class ProductController extends Controller
{
    use ApiResponser;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data =  Product::all();
        return $this->success($data, 'All Product List');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\StoreProductRequest $request
     * @param ProductServices $productServices
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request, ProductServices $productServices)
    {
        $image = $productServices->image($request);
        $data['product'] = Product::create(array_merge($request->all(), $image));
        return $this->success($data, 'Product Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $data['product'] =$product;
        return $this->success($data, 'Product Show Successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\UpdateProductRequest $request
     * @param \App\Models\Product $product
     * @param ProductServices $productServices
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, Product $product, ProductServices $productServices)
    {
        $image = $productServices->image($request);
        $data['product'] = $product->update(array_merge($request->all(), $image));
        return $this->success($data, 'Product Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product,  ProductServices $productService)
    {
        $productService->imageDelete($product->image);
        $product->delete();
        return $this->success('Deleted', 'Product Deleted Successfully');
    }
}
