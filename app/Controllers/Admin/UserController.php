<?php
namespace App\Controllers\Admin;
use App\Models\User;
class UserController {
    public function index(){
        $users = User::all();
        return view("Admin.User.index",compact("users"));
    }
    public function search() {
        $query =trim($_GET['query'] ?? '');
        $users= User::where('username','like','%'.$query.'%')->get();
        return view('Admin.User.index',compact('users'));
    }
}