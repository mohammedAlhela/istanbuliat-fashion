<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admins\ProductRequest;
use App\Http\Resources\Admins\ProductsResource;
use App\Models\Color;
use App\Models\Product;
use App\Models\Size;
use App\Models\SizeGuide;
use App\Models\Tag;
use DB;
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

        SizeGuide::where('product_id', $id)->delete();
    }
    public function deleteProductVariations($id)
    {

        DB::table('variations')->where('product_id', $id)->delete();

    }

    public function getArrayFromString($tagsNamesArray)
    {
        $arrayNames = array();
        $arrayNames = str_replace("[", "", $tagsNamesArray);
        $arrayNames = str_replace("]", "", $arrayNames);
        $arrayNames = explode(",", $arrayNames);
        return $arrayNames;
    }

    public function updateData($product, $request , $id)
    {
        $product->category_id = $request->category_id;
        $product->price = $request->discount_price ? $request->discount_price : $request->selling_price;
        $product->name = $request->name;
        $product->selling_price = $request->selling_price;
        $product->discount_price = $request->discount_price;
        $product->slug = str_replace(" ", "-", $request->name);
        $product->long_description = $request->long_description;
        $product->short_description = $request->short_description;
        $product->offer = $product->discount_price ? (($product->selling_price - $product->discount_price) * 100) / $product->selling_price : null;
        $product->sku = $request->sku;
        if($id == null ) { 
            $product->sizes = $request->sizesNamesArray;
            $product->colors = $request->colorsNamesArray;
            $product->wash_care = "Cold water wash";
            $product->contents = '60% cottons,40% ligra';
        }
     
        $product->wash_care = $request->wash_care;
        $product->contents = $request->contents;
    }

    public function addVariations($request, $product)
    {

        $colorsNamesArray = $this->getArrayFromString($request->colorsNamesArray);

        $sizesNamesArray = $this->getArrayFromString($request->sizesNamesArray);

        $colorsIds = Color::whereIn('name', $colorsNamesArray)->pluck('id')->all();

        $sizesIds = Size::whereIn('name', $sizesNamesArray)->pluck('id')->all();
        foreach ($colorsIds as $colorId) {
            foreach ($sizesIds as $sizeId) {
                DB::table('variations')->insert([
                    'color_id' => $colorId,
                    'size_id' => $sizeId,
                    'product_id' => $product->id,
                    'sku' => $product->sku . $colorId . $sizeId,
                    'selling_price' => $product->selling_price,
                    'discount_price' => $product->discount_price,
                    'image' => '/images/products/variations/variation.jpg',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

    }

    public function uploadImage($product, $id)
    {
        $image = request()->file("image");
        if ($image) {
            // delete old image
            if ($id && file_exists(public_path() . $product->image) && $product->image != "/images/products/product.jpg") {
                unlink(substr($product->image, 1));
            }
            // delete old image
            $imageName = $image->getClientOriginalExtension();
            $imageName = time() . "." . $imageName;
            Image::make($image)->fit(600, 800)->save(public_path("/images/products/") . $imageName, 50);
            if ($product->image && file_exists(public_path() . $product->image) && $product->image != "/images/products/product.jpg") {
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
        $originalTagsNames = Tag::pluck('name')->all();

        $requestTagsNamesArray = $this->getArrayFromString($request->tagsNamesArray);

        foreach ($requestTagsNamesArray as $tagName) {
            if (!in_array($tagName, $originalTagsNames)) {
                $tag = new Tag;
                $tag->name = $tagName;
                $tag->save();
            }
        }

        $tagsIds = Tag::whereIn('name', $requestTagsNamesArray)->pluck('id')->all();

        $product->tags()->sync($tagsIds);

    }

    public function index()
    {
        $products = collect(ProductsResource::collection(Product::orderBy('created_at', 'DESC')->with(['category', 'variations', 'tags', 'colors', 'sizes' , 'sizeGuides'])->get()));
        $tags = DB::table('tags')->get();
        $response = [
            'products' => $products,
            'tags' => $tags,
        ];

        return response($response, 201);
    }

    public function store(ProductRequest $request)
    {
        $product = new product;
        $this->updateData($product, $request , null);
        $this->uploadImage($product, null);
        $this->assignTags($request, $product);
        $this->addVariations($request, $product);

    }

    public function update(ProductRequest $request, $id)
    {

        $product = Product::find($id);
        $this->updateData($product, $request , $id);
        $this->uploadImage($product, $id);
        $this->assignTags($request, $product);
    }

    public function changeStatusOrFeaturedOrTrend(Request $request, $id)
    {

        $product = product::find($id);
        if ($request->updateStatus) {
            $product->status ? $product->status = 0 : $product->status = 1;

        }

        if ($request->updateFeatured) {
            $product->featured ? $product->featured = 0 : $product->featured = 1;

        }

        if ($request->updateTrend) {
            $product->trend ? $product->trend = 0 : $product->trend = 1;

        }

        $product->save();

        $response = [
            'product' => $product,
        ];

        return response($response, 201);

    }

    public function delete($id)
    {

        $product = Product::find($id);

        if (file_exists(public_path() . $product->image) && $product->image != "/images/products/product.jpg") {
            $imageFileDeleted = unlink(substr($product->image, 1));

            if ($updateStatus) {
                $product->delete();
                $this->deleteProductVariations($id);
                $this->deleteSizeGuides($id);
            }

        } else {
            $product->delete();
            $this->deleteProductVariations($id);
            $this->deleteSizeGuides($id);
        }

        $response = [
            'message' => "Record deleted",
        ];

        return response($response, 201);

    }

}
