<?php

namespace App\Http\Controllers;

use App\Models\Subscribe;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->only(['account', ' orders', 'address', 'profileUpdate', 'passwordUpdate']);
    }



    public function index()
    {
        return redirect('/');
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

    public function addSubscriber(Request $request)
    {
        $subscriberIsExist = Subscribe::where('email', $request->email)->first();
        if ($subscriberIsExist === null) {
            $subscriber = new Subscribe;
            $subscriber->email = $request->email;
            $subscriber->save();
        }

        return redirect()->back()->with('message', 'Thank you for your subscription.');
    }

    public function accountUpdate(Request $request)
    {

        $request->validate([
            'name' => 'required|string|min:3|max:255',
            'email' => 'required|string|email| max:255|unique:users,email,' . auth()->user()->id,
            'password' => 'nullable|string|min:8',
        ]);

        $user = User::find(auth()->user()->id);
        $user->name = $request['name'];
        $user->email = $request['email'];
       if($request->password) {
        $user->password = Hash::make($request['password']) ;
       }
        $user->save();
        return back()->with('message', 'Account Informations Updated');


    }

    public function redirectAfterLogin()
    {
        if (Auth::check() && Auth::user()->role ) {
            return redirect('admins/dashboard');
        } elseif (Auth::check() && !Auth::user()->role ) {
            return redirect('/');
        } else {
            return redirect('/');
        }
    }


    public function addressUpdate(Request $request)
    {

     $request->validate([
            'first_name' => 'nullable|min:3',
            'last_name' => 'nullable|min:3',
            'address1' => 'nullable|min:10',
            'address2' => 'nullable|min:10',
            'contact_number' => 'nullable|size:10',
            'zip_code' => 'nullable|size:4',
        ]);

        $user = User::find(auth()->user()->id);
        $user->first_name = $request['first_name'];
        $user->last_name = $request['last_name'];
        $user->address1 = $request['address1'];
        $user->address2 = $request['address2'];
        $user->contact_number = $request['contact_number'];
        $user->zip_code = $request['zip_code'];
        $user->save();
        return back()->with('message', 'Address Informations Updated');
    }

}
