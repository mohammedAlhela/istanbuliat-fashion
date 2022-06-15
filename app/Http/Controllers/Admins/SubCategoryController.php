<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admins\SubCategoryRequest;
use App\Models\SubCategory;
use Image;

class SubCategoryController extends Controller
{

    public function __construct()
    {

        $this->middleware([
            'admin']);

    }

    public function updateData($category, $request)
    {
        $category->name = $request->name;
        $category->arabic_name = $request->arabic_name;
        $category->category_id = $request->category_id;
        
    }

    public function uploadImage($category, $id)
    {

        $image = request()->file("image");
        if ($image) {
            // delete old image
              if ($id && $category->image != '/images/categories/categories/category.webp' && file_exists(public_path() . $category->image)) {
                unlink(substr($category->image, 1));
            }
            // delete old image
        
            $imageName = time() . ".webp" ;
            Image::make($image)->save(public_path("/images/categories/categories/") . $imageName);
            $category->image = "/images/categories/categories/" . $imageName;
        }

        $category->save();

        $response = [
            'category' => $category,
        ];

        return response($response, 201);

    }


    public function store(SubCategoryRequest $request)
    {

        $category = new SubCategory;

        $this->updateData($category, $request);

        $this->uploadImage($category, null);

    }

    public function update(SubCategoryRequest $request, $id)
    {
        $category = SubCategory::find($id);

        $this->updateData($category, $request);

        $this->uploadImage($category, $id);

    }

    public function delete($id)
    {

        $category = SubCategory::find($id);

        if ($category->image != '/images/categories/categories/category.webp' && file_exists(public_path() . $category->image)) {
            $imageFileDeleted = unlink(substr($category->image, 1));

            if ($imageFileDeleted) {

                $category->delete();

            }

        } else {
            $category->delete();

        }

        $response = [
            'category' => $category,
        ];

        return response($response, 201);

    }

    public function updateStatus($id)
    {

        $category = SubCategory::find($id);

        $category->status ? $category->status = 0 : $category->status = 1;

        $category->save();

        $response = [
        'category' => $category,
        ];

        return response($response, 201);

    }

}
