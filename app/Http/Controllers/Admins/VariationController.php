<?php

namespace App\Http\Controllers\Admins;
use App\Http\Controllers\Admins\ProductController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admins\VariationRequest;
use App\Models\Product;
use App\Models\Variation;
use App\Models\Color;
use App\Models\Size;
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


    
    public function updateData($variationImage, $request)
    {

        $variationImage->variation_id = $request->variation_id;
        $variationImage->color_id = $request->color_id;
        $variationImage->size_id = $request->size_id;
    }


    public function updateProduct($product_id)
    {
        $product = Product::find($product_id);
        // update the product options
        $colorsIdsArray = Variation::where('product_id', $product_id)->pluck('color_id')->all();
        $sizesIdsArray = Variation::where('product_id', $product_id)->pluck('size_id')->all();
        $colorsNamesArray = Color::whereIn('id',  $colorsIdsArray )->pluck('name')->all();
        $sizesNamesArray = Size::whereIn('id',  $sizesIdsArray )->pluck('name')->all();
        $colorsString = join(",", $colorsNamesArray);
        $sizesString = join(",", $sizesNamesArray);
        $product->sizes = $sizesString;
        $product->colors = $colorsString;


        // update qty 
        $qty = 0;
        $variations = $product->variations;
        foreach($variations as $variation) { 
            $qty += $variation->stock_qty;
        }
        $product->stock_qty = $qty;
          // update qty 
          $product->save();
     

    }


    public function delete($id)
    {

        $productVariation = Variation::find($id);

        if ( $productVariation->image != '/images/products/variations/variation.jpg' && file_exists(public_path() . $productVariation->image)) {

            $imageFileDeleted = unlink(substr($productVariation->image, 1));

            if ($imageFileDeleted) {

                $productVariation->delete();
                VariationImage::where('variation_id' , $id)->delete();

            }

        } else {
           
            $productVariation->delete();
            VariationImage::where('variation_id' , $id)->delete();
        }

        $this->updateProduct($productVariation->product_id);

        return 'product variation deleted successfully';

    }

    public function add(VariationRequest $request)
    {

        // fetch product
        $product = Product::find($request->product_id);
        // fetch product

        $image = request()->file('image');
        $imageSrc = null;
        $imageName = $image->getClientOriginalExtension();
        $imageName = time() . '.' . $imageName;
        $saveImage = Image::make($image)->fit(600, 800)->save(public_path('/images/products/variations/') . $imageName , 50);
        $imageSrc = '/images/products/variations/' . $imageName;

        DB::table('variations')->insert([
            'sku' => $product->sku.$request->color_id .$request->size_id,
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
            $imageName = $image->getClientOriginalExtension();
            $imageName = time() .'.' . $imageName;
            $saveImage = Image::make($image)->fit(600, 800)->save(public_path('/images/products/variations/') . $imageName , 50);
            $imageSrc = '/images/products/variations/' . $imageName;

            $productVariation = DB::table('variations')->where('id', $id)->get()->first();

            if ($productVariation->image && $productVariation->image != '/images/products/variations/variation.jpg' && file_exists(public_path() . $productVariation->image)) {
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
            'sku' => $product->sku.$request->color_id .$request->size_id,
        ]);

        $this->updateProduct($request->product_id);

        $response = [
            'message' => 'product variation updated successfully',
        ];

        return response($response, 201);

    }

}
