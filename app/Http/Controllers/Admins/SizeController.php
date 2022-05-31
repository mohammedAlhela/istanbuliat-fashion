<?php

namespace App\Http\Controllers\Admins;

use App\Exports\SizeExport;
use App\Http\Controllers\Controller;
use App\Imports\SizeImport;
use App\Models\Product;
use App\Models\Size;
use DB;
use Excel;
use Illuminate\Http\Request;

class SizeController extends Controller
{

    public function __construct()
    {

        $this->middleware([
            'admin']);

    }

    public function updateData($size, $request)
    {
        $size->name = $request->name;

        $size->save();
        $response = [
            'size' => $size,
        ];

        return response($response, 201);
    }

    public function validateData($request, $id)
    {

        $fields = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:sizes,name,' . $id],

        ]);

    }

    public function index()
    {
        $sizes = Size::orderBy('id', 'DESC')->get();

        $response = [
            'sizes' => $sizes,
        ];

        return response($response, 201);
    }

    public function store(Request $request)
    {
        $size = new Size;
        $this->validateData($request, null);
        $this->updateData($size, $request);
    }

    public function update(Request $request, $id)
    {
        $size = Size::find($id);
        $this->validateData($request, $id);
        $this->updateData($size, $request);
    }

    public function delete($id)
    {

        $size = Size::find($id);
        $size->delete();

        $response = [
            'size' =>  $size,
        ];
        return response($response, 201);
    }

    // public function import(Request $request)
    // {

    //     $fields = $request->validate([
    //         'file' => ['required'],

    //     ]);

    //     Excel::import(new SizeImport, request()->file("file"));
    //     return redirect()->back()->with('message', 'data impoted successfully');

    // }

    public function export(Request $request)
    {
        return Excel::download(new SizeExport, 'sizes.xlsx');

    }

}
