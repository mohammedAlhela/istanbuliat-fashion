<?php

namespace App\Http\Controllers\Admins;

use App\Exports\ProductExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admins\ProductRequest;
use App\Models\Product;
use App\Models\ProductColorImage;
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

    public function index()
    {
        return view('admins.products');
    }

    public function deleteSizeGuides($id)
    {

        DB::table('size_guides')->where('product_id', $id)->delete();
    }

    public function deleteImages($id)
    {

        $images = ProductColorImage::where('product_id', $id)->get();

        foreach ($images as $image) {

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

    public function deleteVariations($id)
    {

        DB::table('variations')->where('product_id', $id)->delete();

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
        $product->sub_category_id = $request->sub_category_id;
        $product->price = $request->discount_price ? $request->discount_price : $request->selling_price;
        $product->name = $request->name;
        $product->arabic_name = $request->arabic_name;
        $product->selling_price = $request->selling_price;
        $product->discount_price = $request->discount_price;
        $product->description = $request->description ? $request->description : ""; // long description must be nulable in the table
        $product->arabic_description = $request->arabic_description ? $request->arabic_description : ""; // long description must be nulable in the table
        $product->offer = $product->discount_price ? (($product->selling_price - $product->discount_price) * 100) / $product->selling_price : null;
         $product->sku = $request->sku;
        $product->wash_care = $request->wash_care ? $request->wash_care : '';
        $product->contents = $request->contents;
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
            Image::make($image)->save(public_path("/images/products/") . $imageName);
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
                        'arabic_name' => 'unsigned',
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

    public function getProductsData()
    {
        $products = Product::orderBy('created_at', 'DESC')->with(['category', 'subCategory', 'variations', 'tags', 'colors', 'sizes', 'sizeGuides'])->get();

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

    public function getOptionsData()
    {

        $colors = DB::table('colors')->get();
        $sizes = DB::table('sizes')->get();
        $categories = DB::table('categories')->where('status', 1)->select('id', 'name')->get();
        $subCategories = DB::table('sub_categories')->where('status', 1)->select('id', 'name', 'category_id')->get();
        $response = [
            'colors' => $colors,
            'sizes' => $sizes,
            'categories' => $categories,
            'subCategories' => $subCategories,
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
                $this->deleteImages($id);
            }

        } else {
            $product->delete();
            $this->deleteTags($id);
            $this->deleteSizeGuides($id);
            $this->deleteVariations($id);
            $this->deleteImages($id);
        }

        $response = [
            'message' => "Record deleted",
        ];

        return response($response, 201);

    }

}
