<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SkuRequest;
use App\Models\Product;
use App\Models\Sku;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;

class SkuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Product $product)
    {
        $skus = $product->skus()->paginate(10);
        return view('auth.skus.index', compact('skus', 'product'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(Product $product)
    {
        return view('auth.skus.form', compact('product'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(SkuRequest $request, Product $product)
    {
        $params = $request->all();
        $params['product_id'] = $request->product->id;
        $sku = Sku::create($params);
        $sku->propertyOptions()->sync($request->property_id);
        return redirect()->route('skus.index', compact('product'));
    }

    /**
     * Display the specified resource.
     *
     * @param Sku $sku
     * @return Response
     */
    public function show(Product $product, Sku $sku)
    {
        return view('auth.skus.show', compact('product', 'sku'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Sku $sku
     * @return Response
     */
    public function edit(Product $product, Sku $sku)
    {
        return view('auth.skus.form', compact('product', 'sku'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param SkuRequest $request
     * @param Product $product
     * @param Sku $sku
     * @return RedirectResponse
     */
    public function update(SkuRequest $request, Product $product, Sku $sku)
    {
        $params = $request->all();
        $params['product_id'] = $request->product->id;
        $sku->update($params);
        $sku->propertyOptions()->sync($request->property_id);
        return redirect()->route('skus.index', compact('product','sku',));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Sku $sku
     * @return RedirectResponse
     */
    public function destroy(Product $product, Sku $sku)
    {
//        dd(Str::plural('sku'), Str::singular('skus'));
//        dd($skus);
        $sku->delete();
        return redirect()->route('skus.index', compact('product'));

    }
}
