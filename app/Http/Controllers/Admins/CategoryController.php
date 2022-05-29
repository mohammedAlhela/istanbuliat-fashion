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

    public function uploadImage($big_image, $category, $id)
    {
        if ($big_image) {
            $bigImageName = $big_image->getClientOriginalExtension();
            $bigImageName = time() . "." . $bigImageName;
            Image::make($big_image)->fit(800, 1200)->save(public_path("/images/categories/big/") . $bigImageName);
            $category->big_image = "/images/categories/big/" . $bigImageName;
        }

        // if ($small_image) {
        //     $smallImageName = $small_image->getClientOriginalExtension();
        //     $smallImageName = time() . "." . $smallImageName;
        //     Image::make($small_image)->fit(500, 500)->save(public_path("/images/categories/small/") . $smallImageName);
        //     $category->small_image = "/images/categories/small/" . $smallImageName;
        // }

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

        $category->type = 'main';

        $category->description = $request->description;

        // $small_image = request()->file("small_image");
        $big_image = request()->file("big_image");

        $this->uploadImage($big_image , $category, null);

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
        // $small_image = request()->file("small_image");
        $big_image = request()->file("big_image");

        $this->uploadImage($big_image, $category, $id);

        $category->save();

        $response = [
            'category' => $category,
        ];

        return response($response, 201);
    }

    public function delete($id)
    {

        $category = Category::find($id);

        if ($category->big_image && $category->big_image != '/images/categories/big/category.jpg' && file_exists(public_path() . $category->big_image)) {
            $bigImageDeleted = unlink(substr($category->big_image, 1));
            // $smallImageDeleted = unlink(substr($category->small_image, 1));

            if ($bigImageDeleted ) {

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

    public function updateType($id)
    {

        $category = Category::find($id);

        $category->type === 'main' ? $category->type = 'nav' : $category->type = 'main';

        $category->save();

        $response = [
            'category' => $category,
        ];

        return response($response, 201);

    }

}
