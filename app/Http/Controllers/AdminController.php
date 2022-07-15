<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

class AdminController extends Controller
{
    public function viewAdmins(){

        return view('admin-users');
    }

    public function getAdmins(){
        $admin = Admin::all();

        return $admin;
    }

    public function viewAdminForm(){
        return view('add-admin');
    }

    public function deleteAdmin(Request $request){
        $admin = Admin::find($request->adminID);
        $admin->delete();
        return response()->json('success');
    }
    public function addNewAdmin(Request $request){
        $expiryDate = "9999-12-31";
        if($request->expiryDate != ""){
            $expiryDate = $request->expiryDate;
        }
        $admin = new Admin;
        $admin->firstname = $request->firstname;
        $admin->lastname = $request->lastname;
        $admin->email = $request->email;
        $admin->expiryDate = $expiryDate;
        $admin->username = $request->username;
        $admin->userrole = $request->user_role;
        $admin->password = Hash::make($request->password);
        $admin->save();

        return redirect("/admin-users");
    }
    public function viewEditAdmin(Request $request)
    {
        $admin = Admin::find($request->adminID);
        return view('edit-admin', ['admin'=>$admin]);
    }

    public function editAdmin(Request $request){
        $expiryDate = "9999-12-31";
        if($request->expiryDate != ""){
            $expiryDate = $request->expiryDate;
        }
        $admin = Admin::find($request->adminID);
        $admin->firstname = $request->firstname;
        $admin->lastname = $request->lastname;
        $admin->email = $request->email;
        $admin->expiryDate = $expiryDate;
        $admin->username = $request->username;
        $admin->userrole = $request->user_role;
        $admin->password = Hash::make($request->password);
        $admin->save();

        return redirect("/admin-users");
    }
}
