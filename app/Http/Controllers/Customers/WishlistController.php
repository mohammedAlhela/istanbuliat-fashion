<?php

namespace App\Http\Controllers\Customers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Wishlist;
use Illuminate\Http\Request;

class WishlistController extends Controller
{

    public function __construct()
    {

        $this->middleware([

            'auth']);

    }

    public function index()
    {

        $wishlists = User::where('id', auth()->user()->id)->with('wishlists')->first()->wishlists;

        return view('auth.account.wishlists')->with([
            'wishlists' => $wishlists,

        ]);

    }

    public function getData()
    {

        $wishlists = User::where('id', auth()->user()->id)->with('wishlists')->first()->wishlists;

        $response = [
            'wishlists' => $wishlists,

        ];
        return response($response, 201);
    }

    public function delete($id)
    {

        $wishlist = Wishlist::where('product_id', $id)->where('user_id', auth()->user()->id)->first();
        $wishlist->delete();
        $response = [
            'message' => 'wishlist deleted successfully',
        ];
        return response($response, 201);
    }

    public function add(Request $request)
    {

        if (count(Wishlist::where('user_id', $request->user_id)->where('product_id', $request->product_id)->get())) {
            $response = [
                'message' => 'wishlist already added',
            ];
        } else {
            $wishlist = new Wishlist;
            $wishlist->user_id = auth()->user()->id;
            $wishlist->product_id = $request->product_id;
            $wishlist->save();
            $response = [
                'wishlist' => $wishlist,
            ];

        }

        return response($response, 201);
    }

}
