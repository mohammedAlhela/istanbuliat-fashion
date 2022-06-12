<?php

namespace App\Http\Controllers\Admins;

use App\Exports\ProductExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admins\ProductRequest;
use App\Models\Product;
use App\Models\Variation;
use App\Models\VariationImage;
use DB;
use Excel;
use Illuminate\Http\Request;
use Image;

class ProductController extends Controller
{
    public function __construct()
    {

        $this->middleware([
            'admin']);

    }

    public function deleteSizeGuides($id)
    {

        DB::table('product_tag')->where('product_id', $id)->delete();
    }

    public function deleteVariationImages($variationId)
    {

        $variationImages = VariationImage::where('variation_id', $variationId)->get();

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

    public function deleteVariations($id)
    {

        $variations = Variation::where('product_id', $id)->get();

        foreach ($variations as $productVariation) {

            if ($productVariation->image && $productVariation->image != '/images/products/variations/variation.webp' && file_exists(public_path() . $productVariation->image)) {

                $imageFileDeleted = unlink(substr($productVariation->image, 1));

                if ($imageFileDeleted) {

                    $productVariation->delete();

                    $this->deleteVariationImages($productVariation->id);

                }

            } else {

                $productVariation->delete();
                $this->deleteVariationImages($productVariation->id);

            }

        }

    }

    public function deleteTags($id)
    {

        $relatedTagsIds = DB::table('product_tag')->where('product_id', $id)->pluck('tag_id')->all();
        $relatedTagsNames = DB::table('tags')->whereIn('id', $relatedTagsIds)->pluck('name')->all();

        $notRelatedTagsIds = DB::table('product_tag')->whereNotIn('product_id', [$id])->pluck('tag_id')->all();
        $notRrelatedTagsNames = DB::table('tags')->whereIn('id', $notRelatedTagsIds)->pluck('name')->all();

        foreach ($relatedTagsNames as $relatedTagName) {
            if (!in_array($relatedTagName, $notRrelatedTagsNames)) {
                DB::table('tags')->where('name', $relatedTagName)->delete();
            }
        }

        DB::table('product_tag')->where('product_id', $id)->delete();

    }

    public function getArrayFromString($tagsNamesString)
    {
        $arrayNames = array();
        $arrayNames = str_replace("[", "", $tagsNamesString);
        $arrayNames = str_replace("]", "", $arrayNames);
        $arrayNames = explode(",", $arrayNames);
        return $arrayNames;
    }

    public function updateData($product, $request, $id)
    {
        $product->category_id = $request->category_id;
        $product->price = $request->discount_price ? $request->discount_price : $request->selling_price;
        $product->name = $request->name;
        $product->selling_price = $request->selling_price;
        $product->discount_price = $request->discount_price;
        $product->slug = str_replace(" ", "-", $request->name);
        $product->long_description = $request->long_description ? $request->long_description : ""; // long description must be nulable in the table
        $product->offer = $product->discount_price ? (($product->selling_price - $product->discount_price) * 100) / $product->selling_price : null;
        $product->sku = $request->sku;
        $product->wash_care = $request->wash_care ? $request->wash_care : '';
        $product->contents = $request->contents;
        $product->short_description = '';
    }

    public function addVariations($request, $product)
    {

        $colorsNamesArray = $this->getArrayFromString($request->colorsNamesString);

        $sizesNamesArray = $this->getArrayFromString($request->sizesNamesString);

        $colorsIds = DB::table('colors')->whereIn('name', $colorsNamesArray)->pluck('id')->all();

        $sizesIds = DB::table('sizes')->whereIn('name', $sizesNamesArray)->pluck('id')->all();

        foreach ($colorsIds as $colorId) {
            foreach ($sizesIds as $sizeId) {
                DB::table('variations')->insert([
                    'color_id' => $colorId,
                    'size_id' => $sizeId,
                    'product_id' => $product->id,
                    'sku' => $product->sku . $colorId . $sizeId,
                    'selling_price' => $product->selling_price,
                    'discount_price' => $product->discount_price,

                ]);
            }
        }

    }

    public function uploadImage($product, $id)
    {
        $image = request()->file("image");
        if ($image) {
            // delete old image
            if ($id && file_exists(public_path() . $product->image) && $product->image != "/images/products/product.webp") {
                unlink(substr($product->image, 1));
            }
            // delete old image

            $imageName = time() . ".webp";
            Image::make($image)->fit(600, 800)->save(public_path("/images/products/") . $imageName, 80);
            if ($product->image && file_exists(public_path() . $product->image) && $product->image != "/images/products/product.webp") {
                unlink(substr($product->image, 1));
            }
            $product->image = "/images/products/" . $imageName;
        }

        $product->save();
        $response = [
            'product' => $product,
        ];

        return response($response, 201);
    }

    public function assignTags($request, $product)
    {

        $tagsIds = array();
        if ($request->tagsNamesString) {
            $originalTagsNames = DB::table('tags')->pluck('name')->all();

            $requestTagsNamesArray = $this->getArrayFromString($request->tagsNamesString);
            foreach ($requestTagsNamesArray as $tagName) {
                if (!in_array($tagName, $originalTagsNames)) {

                    DB::table('tags')->insert([
                        'name' => $tagName,
                    ]);

                }
            }
            $tagsIds = DB::table('tags')->whereIn('name', $requestTagsNamesArray)->pluck('id')->all();
        }
        $product->tags()->sync($tagsIds);
        $existProductsTagsNames = array();
        $existProductsTagsIds = DB::table('product_tag')->pluck('tag_id')->all();
        $existProductsTagsNames = DB::table('tags')->whereIn('id', $existProductsTagsIds)->pluck('name')->all();
        DB::table('tags')->whereNotIn('name', $existProductsTagsNames)->delete();
    }

    public function index()
    {
        $products = Product::orderBy('created_at', 'DESC')->with(['category', 'variations', 'tags', 'colors', 'sizes', 'sizeGuides'])->get();

        foreach ($products as $product) {
            $product->contents = $product->contents ? explode(",", $product->contents) : '';
            $product->tagsNamesArray = $product->tags->pluck('name')->all();
        }

        $tags = DB::table('tags')->select('name')->get();
        $response = [
            'products' => $products,
            'tags' => $tags,
        ];

        return response($response, 201);
    }

    public function getOptions()
    {

        $colors = DB::table('colors')->get();
        $sizes = DB::table('sizes')->get();
        $categories = DB::table('categories')->where('status', 1)->select('id', 'name')->get();
        $response = [
            'colors' => $colors,
            'sizes' => $sizes,
            'categories' => $categories,
        ];

        return response($response, 201);
    }

    public function store(ProductRequest $request)
    {
        $product = new product;
        $this->updateData($product, $request, null);
        $this->uploadImage($product, null);
        $this->assignTags($request, $product);
        $this->addVariations($request, $product);

    }

    public function update(ProductRequest $request, $id)
    {

        $product = Product::find($id);
        $this->updateData($product, $request, $id);
        $this->uploadImage($product, $id);
        $this->assignTags($request, $product);
    }

    public function updateStatus($id)
    {

        $product = Product::find($id);

        $product->status ? $product->status = 0 : $product->status = 1;

        $product->save();

        $response = [
            'product' => $product,
        ];

        return response($response, 201);

    }

    public function exportExcel()
    {

        return Excel::download(new ProductExport, 'products.xlsx');

    }

    public function delete($id)
    {

        $product = Product::find($id);

        if (file_exists(public_path() . $product->image) && $product->image != "/images/products/product.webp") {
        $imageFileDeleted = unlink(substr($product->image, 1));

        if ($imageFileDeleted) {
            $product->delete();
            $this->deleteTags($id);
            $this->deleteSizeGuides($id);
            $this->deleteVariations($id);
        }

        } else {
        $product->delete();
        $this->deleteTags($id);
        $this->deleteSizeGuides($id);
        $this->deleteVariations($id);
         }

        $response = [
            'message' => "Record deleted",
        ];

        return response($response, 201);

    }

}
