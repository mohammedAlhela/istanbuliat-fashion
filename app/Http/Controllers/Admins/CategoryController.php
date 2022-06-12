<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admins\CategoryRequest;
use App\Http\Resources\Admins\CategoriesResource;
use App\Models\Category;
use App\Exports\CategoryExport;
use Image;
use Excel;

class CategoryController extends Controller
{

    public function __construct()
    {

        $this->middleware([
            'admin']);

    }

    public function updateData($category, $request)
    {

        $category->name = $request->name;

    }

    public function uploadImage($category, $id)
    {

        $image = request()->file("image");
        if ($image) {
            // delete old image
              if ($id && $category->image != '/images/categories/category.webp' && file_exists(public_path() . $category->image)) {
                unlink(substr($category->image, 1));
            }
            // delete old image
        
            $imageName = time() . ".webp" ;
            Image::make($image)->fit(800, 1200)->save(public_path("/images/categories/") . $imageName, 80);
            $category->image = "/images/categories/" . $imageName;
        }

        $category->save();

        $response = [
            'category' => $category,
        ];

        return response($response, 201);

    }

    public function index()
    {

        $categories = collect(CategoriesResource::collection(Category::select('id' , 'name' , 'status'  , 'image' , 'description' )->orderBy("created_at", "DESC")->with('products')->get()));

        $response = [
            'categories' => $categories,
        ];

        return response($response, 201);

    }

    public function store(CategoryRequest $request)
    {

        $category = new Category;

        $this->updateData($category, $request);

        $this->uploadImage($category, null);

    }

    public function update(CategoryRequest $request, $id)
    {
        $category = Category::find($id);

        $this->updateData($category, $request);

        $this->uploadImage($category, $id);

    }

    public function delete($id)
    {

        $category = Category::find($id);

        if ($category->image != '/images/categories/category.webp' && file_exists(public_path() . $category->image)) {
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

        $category = Category::find($id);

        $category->status ? $category->status = 0 : $category->status = 1;

        $category->save();

        $response = [
            'category' => $category,
        ];

        return response($response, 201);

    }

    
    public function exportExcel()
    {

        return Excel::download(new CategoryExport, 'categories.xlsx');

    }


}
