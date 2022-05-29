<?php

namespace App\Http\Controllers\Admins;

use App\Exports\SizeExport;
use App\Http\Controllers\Controller;
use App\Imports\SizeImport;
use App\Models\Size;
use App\Models\Product;
use App\Models\Variation;
use Excel;
use DB;
use Illuminate\Http\Request;

class SizeController extends Controller
{

    public function __construct()
    {

        $this->middleware([
            'admin']);

    }

    public function validateData($request, $id)
    {

        $fields = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:sizes,name,' . $id],

        ]);

    }

    public function index()
    {
        $sizes = Size::orderBy('id', 'DESC')->with('variations')->get();

        foreach ($sizes as $size) { 
            $productsIds = DB::table('variations')->where('size_id', $size->id)->pluck('product_id')->all();
            $uniqueProductsIds = array();
            foreach ( $productsIds as $productId) { 
             if(!in_array($productId , $uniqueProductsIds)) { 
                array_push($uniqueProductsIds , $productId) ;
             }
            }
            $size->products = Product::whereIn('id' , $uniqueProductsIds)->get() ;
        }


        $response = [
            'sizes' => $sizes,
        ];

        return response($response, 201);
    }

    public function store(Request $request)
    {

        $this->validateData($request, null);

        $size = new Size;
        $size->name = $request->name;

        $size->save();
        $response = [
            'size' => $size,
        ];

        return response($response, 201);
    }

    public function update(Request $request, $id)
    {

        $this->validateData($request, $id);

        $size = Size::find($id);
        $size->name = $request->name;

        $size->save();
        $response = [
            'size' => $size,
        ];

        return response($response, 201);
    }

    public function delete($id)
    {

        $size = Size::find($id);
        $size->delete();

        $response = [
            'message' => 'Size deleted successfully',
        ];
        return response($response, 201);
    }

    public function import(Request $request)
    {

        $fields = $request->validate([
            'file' => ['required'],

        ]);

        Excel::import(new SizeImport,  request()->file("file" ));
        return redirect()->back()->with('message', 'data impoted successfully');

    }

    public function export(Request $request)
    {
        return Excel::download(new SizeExport, 'sizes.xlsx');


    }

}
