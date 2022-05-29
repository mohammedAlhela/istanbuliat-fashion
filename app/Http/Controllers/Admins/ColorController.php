<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Models\Color;
use App\Models\Product;
use Illuminate\Http\Request;
use DB;

use App\Exports\ColorExport;
use App\Imports\ColorImport;
use Excel;


class ColorController extends Controller
{

    public function __construct()
    {

        $this->middleware([
      'admin']);

    }



    public function validateData($request, $id)
    {

        $fields = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:colors,name,' . $id],

        ]);

    }

    public function index()
    {

        $colors = Color::orderBy('id' ,  'DESC')->with('variations')->get();

        foreach ($colors as $color) { 
            $productsIds = DB::table('variations')->where('color_id', $color->id)->pluck('product_id')->all();
            $uniqueProductsIds = array();
            foreach ( $productsIds as $productId) { 
             if(!in_array($productId , $uniqueProductsIds)) { 
                array_push($uniqueProductsIds , $productId) ;
             }
            }
            $color->products = Product::whereIn('id' , $uniqueProductsIds)->get() ;
        }

        $response = [
            'colors' => $colors,
        ];

        return response($response, 201);
    }

    public function store(Request $request)
    {

        $this->validateData($request, null);

        $color = new Color;
        $color->name = $request->name;
        $color->hex = $request->hex;

        $color->save();
        $response = [
            'color' => $color,
        ];

        return response($response, 201);
    }

    public function update(Request $request, $id)
    {

        $this->validateData($request, $id);

        $color = Color::find($id);
        $color->name = $request->name;
        $color->hex = $request->hex;

        $color->save();
        $response = [
            'color' => $color,
        ];

        return response($response, 201);
    }

    public function delete($id)
    {

        $color = Color::find($id);
        $color->delete();
        $response = [
            'message' => 'color deleted successfully',
        ];
        return response($response, 201);
    }

    public function import(Request $request)
    {

        $fields = $request->validate([
            "file" => [ 'required' , "file", "mimes:xlsx"],

        ]);

        Excel::import(new ColorImport,  request()->file("file" ));
   

    }

    public function export(Request $request)
    {
        return Excel::download(new ColorExport, 'colors.xlsx');


    }

}
