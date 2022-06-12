<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admins\VariationRequest;
use App\Models\Product;
use App\Models\Variation;
use App\Models\VariationImage;
use DB;
use Illuminate\Http\Request;
use Image;

class VariationController extends Controller
{

    public function __construct()
    {

        $this->middleware([
            'admin']);

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

    public function updateImages($request)
    {

        $images = VariationImage::where('variation_id', $request->id)->get();

        foreach ($images as $image) {
            $image->color_id = $request->color_id;
            $image->save();
        }

    }

    public function deleteImages($id)
    {

        $variationImages = VariationImage::where('variation_id', $id)->get();

        foreach ($variationImages as $variationImage) {
            if ($variationImage->image != '/images/products/variations/variation.webp' && file_exists(public_path() . $variationImage->image)) {

                $imageFileDeleted = unlink(substr($variationImage->image, 1));

                if ($imageFileDeleted) {

                    $variationImage->delete();

                }

            } else {

                $variationImage->delete();
            }

        }


    }

    public function delete($id)
    {

        $productVariation = Variation::find($id);

        if (  $productVariation->image && $productVariation->image != '/images/products/variations/variation.webp' && file_exists(public_path() . $productVariation->image)) {

            $imageFileDeleted = unlink(substr($productVariation->image, 1));

            if ($imageFileDeleted) {

                $productVariation->delete();
            }

        } else {

            $productVariation->delete();
            
        }

         $this->updateProduct($productVariation->product_id);
        $this->deleteImages($id);

        return 'product variation deleted successfully';

    }

    public function add(VariationRequest $request)
    {

        // fetch product
        $product = Product::find($request->product_id);
        // fetch product
        $imageSrc = null;
        $image = request()->file('image');
        if($image) { 
   
            $imageName = time() . ".webp";
            $saveImage = Image::make($image)->fit(600, 800)->save(public_path('/images/products/variations/') . $imageName, 80);
            $imageSrc = '/images/products/variations/' . $imageName;
        }


        DB::table('variations')->insert([
            'sku' => $product->sku . $request->color_id . $request->size_id,
            'stock_qty' => $request->stock_qty,
            'stock_ordered' => 0,
            'selling_price' => $request->selling_price ? $request->selling_price : $product->selling_price,
            'discount_price' => $request->discount_price ? $request->discount_price : $product->discount_price,
            'product_id' => $request->product_id,
            'color_id' => $request->color_id,
            'size_id' => $request->size_id,
            'image' => $imageSrc,
        ]);

        $this->updateProduct($request->product_id);

        $response = [
            'message' => 'product variation added successfully',
        ];

        return response($response, 201);

    }

    public function update(VariationRequest $request, $id)
    {
        $product = Product::find($request->product_id);

        $image = request()->file('image');
        $imageSrc = null;

        if ($image) {

            $imageName = time() . ".webp";
            $saveImage = Image::make($image)->fit(600, 800)->save(public_path('/images/products/variations/') . $imageName, 80);
            $imageSrc = '/images/products/variations/' . $imageName;

            $productVariation = DB::table('variations')->where('id', $id)->get()->first();

            if ($productVariation->image && $productVariation->image != '/images/products/variations/variation.webp' && file_exists(public_path() . $productVariation->image)) {
                unlink(substr($productVariation->image, 1));
            }

            DB::table('variations')->where('id', $id)->update([
                'image' => $imageSrc,

            ]);
        }

        DB::table('variations')->where('id', $id)->update([
            'stock_qty' => $request->stock_qty,
            'selling_price' => $request->selling_price,
            'discount_price' => $request->discount_price,
            'color_id' => $request->color_id,
            'size_id' => $request->size_id,
            'sku' => $product->sku . $request->color_id . $request->size_id,
        ]);

        $this->updateProduct($request->product_id);
        $this->updateImages($request);

        $response = [
            'message' => 'product variation updated successfully',
        ];

        return response($response, 201);

    }

    public function deleteImage($id)
    {

        $productVariation = Variation::find($id);

        if  ( $productVariation->image &&  $productVariation->image != '/images/products/variations/variation.webp' && file_exists(public_path() . $productVariation->image)) {

            $imageFileDeleted = unlink(substr($productVariation->image, 1));

            if ($imageFileDeleted) {

                $productVariation->image = Null;
              

            }

        } else {

            $productVariation->image = Null;
        }

         $productVariation->save();

        return 'product variation deleted successfully';

    }

}
