<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admins\SliderRequest;
use App\Models\Slider;
use Image;

class SliderController extends Controller
{
    public function __construct()
    {

        $this->middleware([

            'admin',
        ]);
    }

    public function index()
    {

        $sliders = Slider::orderBy("created_at", "DESC")->select('id' , 'title' , 'link' , 'big_image' , 'small_image' , 'status')->get();

        $response = [
            'sliders' => $sliders,
        ];

        return response($response, 201);
    }

    public function updateData($slider, $request)
    {

        $slider->title = $request->title;
        $slider->link = $request->link;
    }

    public function uploadImages($slider, $id)
    {
        $bigImage = request()->file("big_image");
        if ($bigImage) {
            // delete old big image
            if ($id && $slider->big_image != '/images/sliders/big/slider.webp' && file_exists(public_path() . $slider->big_image)) {
                unlink(substr($slider->big_image, 1));
            }
            // delete old big image
            
            $bigImageName = time() . ".webp" ;
            Image::make($bigImage)->fit(1920, 845)->save(public_path("/images/sliders/big/") . $bigImageName, 100);
            $slider->big_image = "/images/sliders/big/" . $bigImageName;
        }

        $smallImage = request()->file("small_image");
        if ($smallImage) {
            // delete old small image
            if ($id && $slider->small_image != '/images/sliders/small/slider.webp' && file_exists(public_path() . $slider->small_image)) {
                unlink(substr($slider->small_image, 1));
            }
            // delete old small image
           
            $smallImageName = time() . ".webp" ;
            Image::make($smallImage)->fit(800, 1200)->save(public_path("/images/sliders/small/") . $smallImageName, 80);
            $slider->small_image = "/images/sliders/small/" . $smallImageName;

        }

        $slider->save();

        $response = [
            'slider' => $slider,
        ];

        return response($response, 201);
    }

    public function store(SliderRequest $request)
    {
        $slider = new Slider;
        $this->updateData($slider, $request);
        $this->uploadImages($slider, null);
    
    }

    public function update(SliderRequest $request, $id)
    {
        $slider = slider::find($id);
        $this->updateData($slider, $request);
        $this->uploadImages($slider, $id);
    }

    public function delete($id)
    {

        $slider = slider::find($id);

        if ($slider->big_image != '/images/sliders/big/slider.webp') {
            $bigImageFileDeleted = false;
            $smallImageFileDeleted = false;
            $bigImageFileIsExist = file_exists(public_path() . $slider->big_image);

            $smallImageFileIsExist = file_exists(public_path() . $slider->small_image);

            if ($bigImageFileIsExist) {
                $bigImageFileDeleted = unlink(substr($slider->big_image, 1));
            }

            if ($smallImageFileIsExist) {
                $smallImageFileDeleted = unlink(substr($slider->small_image, 1));
            }

            if ((!$bigImageFileIsExist && !$smallImageFileIsExist) || (($bigImageFileIsExist && $bigImageFileDeleted) && (!$smallImageFileIsExist)) || (($smallImageFileIsExist && $smallImageFileDeleted) && (!$bigImageFileIsExist)) || (($smallImageFileIsExist && $smallImageFileDeleted) && ($bigImageFileIsExist && $bigImageFileDeleted))) {

                $slider->delete();

            }
        } else {

            $slider->delete();
        }

        $response = [
            'slider' => $slider,

        ];

        return response($response, 201);

    }

    public function updateStatus($id)
    {

        $slider = Slider::find($id);

        $slider->status ? $slider->status = 0 : $slider->status = 1;

        $slider->save();

        $response = [

            'slider' => $slider,
        ];

        return response($response, 201);
    }
}
