<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admins\ProductColorImageRequest;
use App\Models\ProductColorImage;
use Illuminate\Http\Request;
use Image;

class ProductColorImageController extends Controller
{

    public function __construct()
    {
        $this->middleware([
            'admin']);
    }


    public function updateData($image, $request)
    {

        $image->product_id = $request->product_id;
        $image->color_id = $request->color_id;
    }

    public function uploadImage($productColorImage, $id)
    {

        $image = request()->file("image");
    
        if ($image) {
            // delete old image
            if ( $productColorImage->image != '/images/products/images/product.webp' && file_exists(public_path() . $productColorImage->image)) {
                unlink(substr($productColorImage->image, 1));
            }
            // delete old image
     
            $imageName = time() . ".webp" ;
            Image::make($image)->save(public_path("/images/products/images/") . $imageName);
            $productColorImage->image = "/images/products/images/" . $imageName;
        }
    

        else { 
            $productColorImage->image =  '/images/products/images/product.webp' ;
        }




        $productColorImage->save();

        $response = [
            'productColorImage' => $productColorImage,
        ];

        return response($response, 201);

    }

    public function add(ProductColorImageRequest $request)
    {

        $image = new ProductColorImage;

        $this->updateData($image, $request);

        $this->uploadImage($image, null);

    }

    public function update(ProductColorImageRequest $request, $id)
    {

        $image = ProductColorImage::find($id);
        $this->updateData($image, $request);

        $this->uploadImage($image, $id);
  
    }

    public function delete($id)
    {

        $image = ProductColorImage::find($id);

        if ($image->image != '/images/products/images/product.webp' && file_exists(public_path() . $image->image)) {

            $imageFileDeleted = unlink(substr($image->image, 1));

            if ($imageFileDeleted) {

                $image->delete();

            }

        } else {

            $image->delete();
        }

        $response = [
            'image' => $image,
        ];

        return response($response, 201);
    }

}
