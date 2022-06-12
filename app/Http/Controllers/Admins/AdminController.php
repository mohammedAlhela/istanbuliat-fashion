<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Exports\AdminExport;
use App\Http\Requests\Admins\AdminRequest;
use App\Http\Resources\Admins\AdminsResource;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

use Excel;


class AdminController extends Controller
{

    public function __construct()
    {

        $this->middleware([
            'manager']);

    }

    public function index()
    {
        $admins = collect(AdminsResource::collection(User::orderBy('role' ,"DESC" )->select('id' , 'name' , 'email' , 'role' , 'status' , 'last_seen')->where('role', '!=', 0)->get()));

        $response = [
            'admins' => $admins,
        ];

        return response($response, 201);
    }

    public function store(AdminRequest $request)
    {

        $user = new User;
        $user->name = $request->name;
        $user->password = Hash::make($request->password);
        $user->email = $request->email;
        $user->role = 1;
        $user->email_verified_at = now();

        $user->save();
        $response = [
            'user' => $user,
        ];

        return response($response, 201);
    }

    public function update(AdminRequest $request, $id)
    {

        $user = User::find($id);
        $user->name = $request->name;
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }
        $user->email = $request->email;
        $user->save();
        $response = [
            'user' => $user,
        ];

        return response($response, 201);
    }

    public function delete($id)
    {

            $user = User::find($id);
            $user->delete();
            $response = [
                'user' => $user,
            ];

            return response($response, 201);
    }


    public function exportExcel()
    {

        return Excel::download(new AdminExport, 'admins.xlsx');
    }


    public function updateStatus($id)
    {

        $user = User::find($id);

        $user->status ? $user->status = 0 : $user->status = 1;

        $user->save();

        $response = [
            'user' => $user,
        ];

        return response($response, 201);

    }

}
