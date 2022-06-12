<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admins\VariationImageRequest;
use App\Models\VariationImage;
use Illuminate\Http\Request;
use Image;

class VariationImageController extends Controller
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

    public function uploadImage($variationImage, $id)
    {

        $image = request()->file("image");
        if ($image) {
            // delete old image
            if ($id && $variationImage->image != '/images/products/variations/variation.webp' && file_exists(public_path() . $variationImage->image)) {
                unlink(substr($variationImage->image, 1));
            }
            // delete old image
     
            $imageName = time() . ".webp" ;
            Image::make($image)->fit(600, 800)->save(public_path("/images/products/variations/") . $imageName , 80);
            $variationImage->image = "/images/products/variations/" . $imageName;
        }

        if($id == null) { 
            $variationImage->image = "/images/products/variations/variation.webp";
        }

        $variationImage->save();

        $response = [
            'variationImage' => $variationImage,
        ];

        return response($response, 201);

    }

    public function add(VariationImageRequest $request)
    {

        $variationImage = new VariationImage;

        $this->updateData($variationImage, $request);

        $this->uploadImage($variationImage, null);

    }

    public function update(VariationImageRequest $request, $id)
    {

        $variationImage = VariationImage::find($id);
        $this->updateData($variationImage, $request);

        $this->uploadImage($variationImage, $id);
  
    }

    public function delete($id)
    {

        $variationImage = VariationImage::find($id);

        if ($variationImage->image != '/images/products/variations/variation.webp' && file_exists(public_path() . $variationImage->image)) {

            $imageFileDeleted = unlink(substr($variationImage->image, 1));

            if ($imageFileDeleted) {

                $variationImage->delete();

            }

        } else {

            $variationImage->delete();
        }

        $response = [
            'variationImage' => $variationImage,
        ];

        return response($response, 201);
    }

}
