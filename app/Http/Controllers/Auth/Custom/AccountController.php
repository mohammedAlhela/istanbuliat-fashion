<?php

namespace App\Http\Controllers\Auth\Custom;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->only(['account', ' orders', 'address', 'accountUpdate' , 'addressUpdate']);
    }

    public function account()
    {
        return view('auth.account.account');
    }

    public function orders()
    {
        return view('auth.account.orders');
    }

    public function address()
    {
        return view('auth.account.address');
    }

    public function accountUpdate(Request $request)
    {

        $request->validate([
            'username' => 'required|string|min:3|max:255',
            'email' => 'required|string|email| max:255|unique:users,email,' . auth()->user()->id,
            'password' => 'nullable|string|min:8',
        ]);

        $user = User::find(auth()->user()->id);
        $user->username = $request['username'];
        $user->email = $request['email'];
       if($request->password) {
        $user->password = Hash::make($request['password']) ;
       }
        $user->save();
        return back()->with('message', 'Account Informations Updated');


    }

    public function addressUpdate(Request $request)
    {

        $user = User::find(auth()->user()->id);
        $user->first_name = $request['first_name'];
        $user->last_name = $request['last_name'];
        $user->address = $request['address'];
        $user->emirate = $request['emirate'];
        $user->street = $request['street'];
        $user->contact_number = $request['contact_number'];
        $user->zip_code = $request['zip_code'];
        $user->save();
        return back()->with('message', 'Address Informations Updated');
    }

}
