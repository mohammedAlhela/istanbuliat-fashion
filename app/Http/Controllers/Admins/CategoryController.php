<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admins\CategoryRequest;
use App\Models\Category;
use Image;

class CategoryController extends Controller
{

    public function __construct()
    {

        $this->middleware([
            'admin']);

    }

    public function uploadImage($image, $category, $id)
    {
        if ($image) {
            $imageName = $image->getClientOriginalExtension();
            $imageName = time() . "." . $imageName;
            Image::make($image)->fit(800, 1200)->save(public_path("/images/categories/") . $imageName);
            $category->image = "/images/categories/" . $imageName;
        }


    }

    public function index()
    {

        $categories = Category::orderBy("created_at", "DESC")->with('products')->get();

        $response = [
            'categories' => $categories,
        ];

        return response($response, 201);

    }

    public function store(CategoryRequest $request)
    {

        $category = new Category;

        $category->name = $request->name;

        $category->description = $request->description;

        $image = request()->file("image");

        $this->uploadImage($image , $category, null);

        $category->save();

        $response = [
            'category' => $category,
        ];

        return response($response, 201);
    }

    public function update(CategoryRequest $request, $id)
    {
        $category = Category::find($id);

        $category->name = $request->name;

        $category->description = $request->description;
  
        $image = request()->file("image");

        $this->uploadImage($image, $category, $id);

        $category->save();

        $response = [
            'category' => $category,
        ];

        return response($response, 201);
    }

    public function delete($id)
    {

        $category = Category::find($id);

        if ($category->image && $category->image != '/images/categories/category.jpg' && file_exists(public_path() . $category->image)) {
            $imageDeleted = unlink(substr($category->image, 1));

            if ($imageDeleted ) {

                $category->delete();

            }

        } else {
            $category->delete();

        }

        $response = [
            'message' => "Category deleted",
        ];

        return response($response, 201);

    }

    public function updateStatus($id)
    {

        $category = Category::find($id);

        $category->status  ? $category->status = 0 :  $category->status = 1;

        $category->save();

        $response = [
            'category' => $category,
        ];

        return response($response, 201);

    }

}
