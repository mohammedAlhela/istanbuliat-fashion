<?php

namespace App\Http\Resources\Admins;

use App\Models\Color;
use App\Models\Size;
use App\Models\Tag;
use DB;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductsResource extends JsonResource
{

    public function __construct($resource)
    {
        // Ensure we call the parent constructor
        parent::__construct($resource);
        $this->resource = $resource; // $apple param passed
    }

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */

    public function toArray($request)
    {

        // generste colors and sizes records
        $productcolorsIds = DB::table('variations')->where('product_id', $this->id)->pluck('color_id')->all();
        $productSizesIds = DB::table('variations')->where('product_id', $this->id)->pluck('size_id')->all();

        $relatedColors = DB::table('colors')->whereIn('id', $productcolorsIds)->get();
        $relatedSizes = DB::table('sizes')->whereIn('id', $productSizesIds)->get();
        // generste colors and sizes records

        //generate tags array and string from the relation tags
        $tagsNamesArray = array();
        $tagsNamesString = '';

        if (count($this->tags)) {
            $productTagsIds = DB::table('product_tag')->where('product_id', $this->id)->pluck('tag_id')->all();
            $tagsNamesArray = Tag::whereIn('id', $productTagsIds)->pluck('name')->all();
            $tagsNamesString = join(",", $tagsNamesArray);
        }
       // generate tags array and string from the relation tags

        // generate colors array and string from the relation colors
        $colorsNamesArray = array();
        $colorsNamesString = '';

        if (count( $relatedColors)) {
            $productcolorsIds = DB::table('variations')->where('product_id', $this->id)->pluck('color_id')->all();
            $colorsNamesArray = Color::whereIn('id', $productcolorsIds)->pluck('name')->all();
            $colorsNamesString = join(",", $colorsNamesArray);
        }
        // generate colors array and string from the relation colors

        // generate sizes array and string from the relation sizes
        $sizesNamesArray = array();
        $sizesNamesString = '';
        if (count($relatedSizes)) {
            $productsizesIds = DB::table('variations')->where('product_id', $this->id)->pluck('size_id')->all();
            $sizesNamesArray = Size::whereIn('id', $productsizesIds)->pluck('name')->all();
            $sizesNamesString = join(",", $sizesNamesArray);
        }
        // generate sizes array and string from the relation sizes

        // calc qty and orders from the variations
        $total_qty = 0;
        $total_ordered = 0;

        $productVariations = DB::table('variations')->where('product_id', $this->id)->get();

        foreach ($productVariations as $variation) {
            $total_qty += (int) $variation->stock_qty;
            $total_ordered += (int) $variation->stock_ordered;
        }

        // calc and qty orders from the variations

        return [

            'id' => $this->id,

            'name' => $this->name,

            'image' => $this->image,

            'relatedColors' => $relatedColors,

            'relatedSizes' => $relatedSizes,

            'selling_price' => $this->selling_price,

            'discount_price' => $this->discount_price,

            'price' => $this->price,

            'exact_price' => $this->exact_price,

            'variations' => $this->variations,

            'sizeGuides' => $this->sizeGuides,

            'tags' => $this->tags,

            'tagsNamesString' => $tagsNamesString, // search

            'tagsNamesArray' => $tagsNamesArray, // push new tags

            'colorsNamesString' => $colorsNamesString, // search

            'colorsNamesArray' => $colorsNamesArray, // push new colors

            'sizesNamesString' => $sizesNamesString, // search

            'sizesNamesArray' => $sizesNamesArray, // push new sizes

            'slug' => $this->slug,
            'sku' => $this->sku,

            'category_id' => $this->category_id,

            'category' => $this->category,

            'short_description' => $this->short_description,

            'long_description' => $this->long_description,

            'status' => $this->status,

            'featured' => $this->featured,

            'trend' => $this->trend,

            'created_at' => $this->created_at,

            'updated_at' => $this->updated_at,

            'stock_orders' => $total_qty,

            'stock_qty' => $total_ordered,

            'colors' => $this->colors,

            'sizes' => $this->sizes,
            'wash_care' => $this->wash_care,
            'contents' =>  explode(",", $this->contents) ,

        ];   

    }
}
