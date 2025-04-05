<?php
namespace App\Controllers\Admin;
use App\Models\User;
class UserController {
    public function index(){
        $users = User::all();
        return view("Admin.user.list",compact("users"));
    }
    public function search() {
        $query=trim($_GET['name'] ?? '');
        $id=trim($_GET['id'] ?? '');
        $role=trim($_GET['role'] ?? '');
        $status=trim($_GET['status'] ?? '');

        $hasWhere=false;
        $users=null;

        if($query !== ''){
            $users = User::where('full_name','LIKE',"%$query%");
            $hasWhere=true;
        }

        if($id !== ''){
            if($hasWhere){
                $users->andWhere('id','=',$id);
            }else{
                $users=User::where('id','=',$id);
                $hasWhere=true;
            }
        }


        if($role !== ''){
            if($hasWhere){
                $users->andWhere('role','=',$role);
            }else{
                $users=User::where('role','=',$role);
                $hasWhere=true;
            }
        }

        if($status !== ''){
            if($hasWhere){
                $users->andWhere('status','=',$status);
            }else{
                $users=User::where('status','=',$status);
                $hasWhere=true;
            }
        }

        if(!$hasWhere){
            $users=User::all();
        }else{
            $users=$users->get();
        }
        return view("Admin.user.list",compact('users'));
    }
}