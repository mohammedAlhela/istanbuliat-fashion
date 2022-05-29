<?php

namespace App\Http\Controllers\Admins;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admins\VariationImageRequest;
use App\Models\Variation;
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




    public function delete($id)
    {

        $variationImage = VariationImage::find($id);

        if ($variationImage->image && $variationImage->image != '/images/products/variations/variation.jpg' && file_exists(public_path() . $variationImage->image)) {

            $fileDeleted = unlink(substr($variationImage->image, 1));

            if ($fileDeleted) {

                $variationImage->delete();
            }

        } else {
           
            $variationImage->delete();
        }

        return 'variation image deleted successfully';
    }




    
    public function add(VariationImageRequest $request)
    {

        $variationImage =  new VariationImage;

            $image = request()->file("image");
            $imageName = $image->getClientOriginalExtension();
            $imageName = time() . "." . $imageName;
            Image::make($image)->fit(600, 800)->save(public_path("/images/products/variations/") . $imageName);
            $variationImage->image = "/images/products/variations/" . $imageName;
     

        $variationImage->variation_id = $request->variation_id;
        $variationImage->color_id = $request->color_id;
        $variationImage->size_id = $request->size_id;
   
        $variationImage->save();

        $response = [
            'variationImage' => $variationImage,
        ];

        return response($response, 201);

    }


    public function update(VariationImageRequest $request , $id)
    {

        $variationImage =  VariationImage::find($id);
        $image = request()->file("image");

        if ($image) {

            if ($variationImage->image && $variationImage->image != '/images/products/variations/variation.jpg' && file_exists(public_path() . $variationImage->image)) {
                  unlink(substr($variationImage->image, 1));
            }
            $image = request()->file("image");
            $imageName = $image->getClientOriginalExtension();
            $imageName = time() . "." . $imageName;
            Image::make($image)->fit(600, 800)->save(public_path("/images/products/variations/") . $imageName);
            $variationImage->image = "/images/products/variations/" . $imageName;
        }

        $variationImage->variation_id = $request->variation_id;
        $variationImage->color_id = $request->color_id;
        $variationImage->size_id = $request->size_id;
   
        $variationImage->save();

        $response = [
            'variationImage' => $variationImage,
        ];

        return response($response, 201);

    }
}
