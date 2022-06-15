<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admins\VariationRequest;
use App\Models\Product;
use App\Models\ProductColorImage;
use App\Models\SizeGuide;
use App\Models\Variation;
use DB;

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

    public function updatSizeGuides()
    {

        $relationalSizesIds = array();
        $products = Product::all();

        foreach ($products as $product) {
            foreach ($product->sizes as $size) {
                array_push($relationalSizesIds, $size->id);
            }
        }

        $relationalSizesIds = array_unique($relationalSizesIds);

        $allSizesIdsInSizesGuides = SizeGuide::pluck('size_id')->all();

        foreach ($allSizesIdsInSizesGuides as $item) {

            if (!in_array($item, $relationalSizesIds)) {

                DB::table('size_guides')->where('size_id', $item)->delete();

            }
        }

    }

    public function updateProductColorImages()
    {

        $relationalColorsIds = array();
        $products = Product::all();

        foreach ($products as $product) {
            foreach ($product->colors as $color) {
                array_push($relationalColorsIds, $color->id);
            }
        }

        $allColorsIdsInProductColorImages = ProductColorImage::pluck('color_id')->all();

        foreach ($allColorsIdsInProductColorImages as $item) {
            if (!in_array($item, $relationalColorsIds)) {
                $image = ProductColorImage::where('color_id', $item)->first();

                if ($image->image != '/images/products/images/product.webp' && file_exists(public_path() . $image->image)) {
                    $imageFileDeleted = unlink(substr($image->image, 1));

                    if ($imageFileDeleted) {

                        $image->delete();

                    }

                } else {
                    $image->delete();

                }

            }
        }

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
        $this->updatSizeGuides();
        $this->updateProductColorImages();

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
        $this->updatSizeGuides();
        $this->updateProductColorImages();
    }

}
