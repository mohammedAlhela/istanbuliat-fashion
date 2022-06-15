<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admins\VariationRequest;
use App\Models\Product;
use App\Models\Variation;

class VariationController extends Controller
{

    public function __construct()
    {

        $this->middleware([
            'admin']);

    }

    public function updateData($variation, $request)
    {

        $variation->product_id = $request->product_id;
        $variation->size_id = $request->size_id;
        $variation->color_id = $request->color_id;
        $variation->stock_qty = $request->stock_qty;
        $variation->selling_price = $request->selling_price;
        $variation->discount_price = $request->discount_price;

        $variation->save();
        $response = [
            'variation' => $variation,
        ];
        return response($response, 201);
    }

    public function updateProduct($product_id)
    {
        $product = Product::find($product_id);

        // update qty
        $qty = 0;
        $variations = $product->variations;
        foreach ($variations as $variation) {
            $qty += $variation->stock_qty;
        }
        $product->stock_qty = $qty;
        // update qty
        $product->save();

    }

    public function delete($id)
    {

        $variation = Variation::find($id);

        $variation->delete();

        $this->updateProduct($variation->product_id);

        $response = [
            'variation' => $variation,
        ];

        return response($response, 201);

    }

    public function add(VariationRequest $request)
    {
        $variation = new Variation;
        $this->updateData($variation, $request);
        $this->updateProduct($request->product_id);
    }

    public function update(VariationRequest $request, $id)
    {
        $variation = Variation::find($id);
        $this->updateData($variation, $request);
        $this->updateProduct($request->product_id);

    }

}
