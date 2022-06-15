<?php

namespace App\Http\Controllers\Admins;

use App\Exports\Admins\SizeExport;
use App\Http\Controllers\Controller;
use App\Models\Size;
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

    public function getData()
    {
        $sizes = Size::orderBy('id', 'DESC')->with('products')->get();

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


    public function export(Request $request)
    {
        return Excel::download(new SizeExport, 'sizes.xlsx');

    }

}
