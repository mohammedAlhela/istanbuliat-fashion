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

            'admin']);

    }

    public function index()
    {

        $sliders = Slider::orderBy("created_at", "DESC")->get();

        $response = [
            'sliders' => $sliders,
        ];

        return response($response, 201);

    }

    public function store(SliderRequest $request)
    {
        $slider = new Slider;
        $slider->title = $request->title;
        $slider->link = $request->link;

        $big_image = request()->file("big_image");
        $bigImageName = $big_image->getClientOriginalExtension();
        $bigImageName = time() . "." . $bigImageName;
        Image::make($big_image)->fit(1920, 845)->save(public_path("/images/sliders/big/") . $bigImageName);

        $small_image = request()->file("small_image");
        $smallImageName = $small_image->getClientOriginalExtension();
        $smallImageName = time() . "." . $smallImageName;
        Image::make($small_image)->fit(800, 1200)->save(public_path("/images/sliders/small/") . $smallImageName);

        $slider->big_image = "/images/sliders/big/" . $bigImageName;
        $slider->small_image = "/images/sliders/small/" . $smallImageName;

        $slider->save();

        $response = [
            'slider' => $slider,
        ];

        return response($response, 201);

    }

    public function update(SliderRequest $request, $id)
    {
        $slider = slider::find($id);
        $slider->title = $request->title;
        $slider->link = $request->link;

        // add images section +++++++++++
        $big_image = request()->file("big_image");
        $small_image = request()->file("small_image");

        if ($big_image) {
            // delete the old big image

            if ($slider->big_image && $slider->big_image != '/images/sliders/big/slider.jpg' && file_exists(public_path() . $slider->big_image)) {
                unlink(substr($slider->big_image, 1));
            }

            $bigImageName = $big_image->getClientOriginalExtension();
            $bigImageName = time() . "." . $bigImageName;
            Image::make($big_image)->fit(1920, 845)->save(public_path("/images/sliders/big/") . $bigImageName);
            $slider->big_image = "/images/sliders/big/" . $bigImageName;

        }

        if ($small_image) {
            // delete the old big image

            if ($slider->small_image && $slider->small_image != '/images/sliders/small/slider.jpg' && file_exists(public_path() . $slider->small_image)) {
                unlink(substr($slider->small_image, 1));
            }

            $smallImageName = $small_image->getClientOriginalExtension();
            $smallImageName = time() . "." . $smallImageName;
            Image::make($small_image)->fit(800, 1200)->save(public_path("/images/sliders/small/") . $smallImageName);

            $slider->small_image = "/images/sliders/small/" . $smallImageName;

        }

        $slider->save();

        $response = [
            'slider' => $slider,
        ];

        return response($response, 201);
    }

    public function delete($id)
    {

        $slider = slider::find($id);

        if ($slider->big_image && $slider->big_image != '/images/sliders/big/slider.jpg' && file_exists(public_path() . $slider->big_image)) {
            $bigImageDeleted = unlink(substr($slider->big_image, 1));
            $smallImageDeleted = unlink(substr($slider->small_image, 1));

            if ($bigImageDeleted && $smallImageDeleted) {

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
