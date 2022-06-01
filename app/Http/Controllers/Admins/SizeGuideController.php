<?php

namespace App\Http\Controllers\Admins;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admins\SizeGuideRequest;
use App\Models\Variation;
use App\Models\SizeGuide;
use Illuminate\Http\Request;


class SizeGuideController extends Controller
{

    public function __construct()
    {
        $this->middleware([
            'admin']);
    }

    public function delete($id)
    {
        $sizeGuide = SizeGuide::find($id);
        $sizeGuide->delete();
        $response = [
            'sizeGuide' => $sizeGuide,
        ];
        return response($response, 201);
    }

    public function updateData($sizeGuide, $request)
    {
        $sizeGuide->product_id = $request->product_id;
        $sizeGuide->size_id = $request->size_id;
        $sizeGuide->product_name = $request->product_name;
        $sizeGuide->size_name = $request->size_name;
        $sizeGuide->shoulder = $request->shoulder;
        $sizeGuide->bust = $request->bust;
        $sizeGuide->wist = $request->wist;
        $sizeGuide->hip = $request->hip;
        $sizeGuide->length = $request->length ? $request->length : '0' ;
        $sizeGuide->save();
        $response = [
            'sizeGuide' => $sizeGuide,
        ];
        return response($response, 201);
    }


    public function add(SizeGuideRequest $request)
    {
        $sizeGuide =  new SizeGuide;
        $this->updateData($sizeGuide , $request);
   
     
    }

    public function update(SizeGuideRequest $request , $id)
    {

        $sizeGuide =   SizeGuide::find($id);
        $this->updateData($sizeGuide , $request);

    }
}
