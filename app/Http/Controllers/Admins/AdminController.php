<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Exports\Admins\AdminExport;
use App\Http\Requests\Admins\AdminRequest;
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
 
        return  view('admins.admins');
    }

    public function getData()
    {
        $admins = User::orderBy('role' ,"DESC" )->where('role', '!=', 0)->select('id' , 'username' , 'last_seen' , 'email' , 'role' , 'status' , 'password')->get();

        $response = [
            'admins' => $admins,
        ];

        return response($response, 201);
    }

    public function updateData($user, $request, $id)
    {
     
        $user->username = $request->username;
        if($request->password) { 
            $user->password = Hash::make($request->password);
        }
        $user->email = $request->email;
        $user->role = 1;
        $user->save();
        $response = [
            'user' => $user,
        ];
        return response($response, 201);
    }

    public function store(AdminRequest $request)
    {

        $user = new User;
        $this->updateData($user , $request , null);
    


    }

    public function update(AdminRequest $request, $id)
    {

        $user = User::find($id);
        $this->updateData($user , $request , $id);

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
