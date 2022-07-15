<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserController extends Controller
{
    public function storeUserData(Request $request){
        //obtaining form data
        $name = $request->input('name', 'user');
        $email = $request->input('email', 'user');
        $password = $request->input('password', 'user');
        $mobileNumber = $request->input('mobileNumber', 'user');
        $address = $request->input('address', 'user');
        //check if record exists
        if (self::userExists($email)){
            $error = 'Error! Email is already registered!';
            return view('register', ['error' => $error]);
        }
        //inserting into DB
        /*$user = new User;
        $user->email = $email;
        $user->name = $name;
        $user->password = Hash::make($password);
        $user->mobileNumber = $mobileNumber;
        $user->address = $address;
        $user->balance = 0;
        $user->isCreditCard = 0;
        $user->joinedDate = now();
        $user->save();*/
        DB::insert('insert into user (email, name, password, mobileNumber, address, balance, isCreditCard, joinedDate) values (?, ?, ?, ?, ?, ?, ?, ?)', 
            [$email, $name, Hash::make($password), $mobileNumber, $address, 0, 0, now()]
        );
        //going to login
        return view('login', ['email' => $email, 'password' => $password]);
    }
    public function login(Request $request){
        Session::flush();   //clearing previous session
        $email = $request->input('email');
        $password = $request->input('password');
        $result = DB::select('select * from user where email = ?', [$email]);
        //$result = User::where('email', '=' , $email)->get();
        $user = null;
        foreach($result as $r){
            $user = $r;
        }
        
        if ($user == null || !Hash::check($password, $user->password)){
            $error = 'Error! Invalid email or Password!';
            //return view('login', ['error' => $error]);
            return redirect('login')->with(['error'=> $error]);
        }
        self::storeUserinSession($user);
        return redirect('/home');
    }
    public function loadSite(){
        if (Session::has('user')){
            return redirect('/home');
        }
        else{
            return redirect('/login');
        }
    }
    public function loadUser(){
        if (!(Session::has('user')))
            return;
        $user = Session::get('user');
        return view('profile', ['user' => $user]);
    }
    public function updateUserBalance(Request $request){
        if (!(Session::has('user')))
            return;
        $amount = (int)$request->input('amount');
        $user = Session::get('user');
        $userid = $user->idUser;
        DB::update('update user set balance = ? where idUser = ?', [$user->balance + $amount, $userid]);
        $user->balance = $user->balance + $amount;
        return redirect('/profile');
    }
    public function updateCreditCard(){
        if (!(Session::has('user')))
            return;
        $user = Session::get('user');
        $userid = $user->idUser;
        DB::update('update user set isCreditCard = 1 where idUser = ?', [$userid]);
        $user->isCreditCard = 1;
        return redirect('/profile');
    }
    public function logout(){
        Session::flush();
        return redirect('/login');
    }
    public function updatePassword(Request $request){
        $email = $request->input('mail');
        $newPassword = $request->input('newPassword');
        DB::update('UPDATE user set password = ? where email = ?', [Hash::make($newPassword), $email]);
        /*$user = User::where('email', '=', $email);
        $user->password = Hash::make($newPassword);
        $user->update(['password' => $user->password]);*/
        return redirect('/login');
    }
    private function storeUserinSession($user){
        Session::put('user', $user);
    }
    private function userExists($email){
        $result = DB::select('select * from user where email = ?', [$email]);
        //$result = User::where('email', '=' , $email)->get();
        foreach($result as $r){
            return true;    //if record found    
        }
        return false;
    }
}
