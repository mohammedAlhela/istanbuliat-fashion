<?php

namespace App\Http\Controllers\Admins;

use App\Exports\ColorExport;
use App\Http\Controllers\Controller;
use App\Models\Color;
use Excel;
use Illuminate\Http\Request;

class ColorController extends Controller
{

    public function __construct()
    {

        $this->middleware([
            'admin']);

    }

    public function updateData($color, $request)
    {

        $color->name = $request->name;
        $color->hex = $request->hex;

        $color->save();
        $response = [
            'color' => $color,
        ];

        return response($response, 201);
    }

    public function validateData($request, $id)
    {

        $fields = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:colors,name,' . $id],

        ]);

    }

    public function index()
    {

        $colors = Color::orderBy('id', 'DESC')->with('products')->get();

        $response = [
            'colors' => $colors,
        ];

        return response($response, 201);
    }

    public function store(Request $request)
    {
        $color = new Color;
        $this->validateData($request, null);
        $this->updateData($color, $request);
    }

    public function update(Request $request, $id)
    {
        $color = Color::find($id);
        $this->validateData($request, $id);
        $this->updateData($color, $request);
    }

    public function delete($id)
    {

        $color = Color::find($id);
        $color->delete();
        $response = [
            'color' => $color,
        ];
        return response($response, 201);
    }

    public function export(Request $request)
    {
        return Excel::download(new ColorExport, 'colors.xlsx');

    }

}
