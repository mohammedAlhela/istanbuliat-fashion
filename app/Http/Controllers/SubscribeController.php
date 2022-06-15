<?php

namespace App\Http\Controllers;

use App\Models\Subscribe;
use Illuminate\Http\Request;

class SubscribeController extends Controller
{
    public function subscribe(Request $request)
    {
        $subscriberIsExist = Subscribe::where('email', $request->email)->first();
        if ($subscriberIsExist == null) {
            $subscriber = new Subscribe;
            $subscriber->email = $request->email;
            $subscriber->save();
        }

        return redirect()->back()->with('message', 'Thank you for your subscription.');
    }


}
