<?php

namespace App\Http\Controllers\Customers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Color;
use App\Models\Size;

class ProductDetailsController extends Controller
{

    public function index($slug)
    {

        $slugs = Product::pluck('slug')->all();

        $slugIsValid = in_array($slug, $slugs);

        if (!$slugIsValid) {

          return view('errors.404');

        } else {

            $product = Product::
            with(['category', 'variations', 'colors', 'sizes'])->where('slug', $slug)->first();
            $variations = $product->variations;

            $relatedProducts = Product::
                    with(['category'])
                    ->where('category_id', $product->category_id)
                    ->where('id', '!=', $product->id)
                    ->get();



            //  getting product related colors and sizes from variations  
            $colorsIds = [];
            $sizesIds = [];
            $slidersImages = [];
            $variations = $product->variations;  
            foreach ($variations as $variation) { 
                if(!in_array($variation->color_id , $colorsIds)) { 
                    array_push($colorsIds , $variation->color_id) ;
                 }

                 if(!in_array($variation->size_id , $sizesIds)) { 
                    array_push($sizesIds , $variation->size_id) ;
                 }
            }

            $colors = Color::whereIn('id' , $colorsIds)->get();
            $sizes = Size::whereIn('id' , $sizesIds)->get();
             //  getting product related colors and sizes from variations 

             $productVariation = new \stdClass ;
             $productVariation->id =  $product->id;  
             $productVariation->variation_id = count($variations)  ? $variations[0]->id :  $product->id  ; 
             $productVariation->color_id =  2   ;
             $productVariation->size_id =   2  ;
             $productVariation->image =  $product->image; 
             array_push($slidersImages , $productVariation);

            
              foreach ($variations as $key=>$variation) { 
                     foreach ($variation->images as $imageKey=>$image)   { 
                   
                        array_push($slidersImages , $image) ;
                     }   

                     $baseVariation = new \stdClass();
                     $baseVariation->id =  $variation->id + $variation->color_id + $variation->size_id;  
                     $baseVariation->variation_id =  $variation->id + $variation->color_id + $variation->size_id; 
                     $baseVariation->color_id =  $variation->color_id  ;
                     $baseVariation->size_id =  $variation->size_id ;
                     $baseVariation->image =  $variation->image; 
                     
   

                        if($baseVariation->image && $baseVariation->image != "/images/products/variations/variation.webp") { 
                            array_push($slidersImages , $baseVariation) ;
                        }
            
                   
                   
              }





            return view('customers.product-details')->with([
                'product' => $product,
                'colors' => $colors,
                'sizes' => $sizes,
                'relatedProducts' => $relatedProducts,
                'productDetailsImagesSliders' => $slidersImages,
                'sizeGuides' => $product->sizeGuides,
                'variations' => $variations

            ]);
        }

    }

}
