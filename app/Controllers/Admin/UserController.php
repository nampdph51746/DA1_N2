<?php
namespace App\Controllers\Admin;
use App\Models\User;
use eftec\bladeone\BladeOne;
use App\Services\Authorization;

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

    public function edit($id){
        $user = User::find($id);
         
        return view('Admin.user.edit',compact('user'));
    }
    public function update($id){
        $data= $_POST;
        User::update($data,$id);
        $users = User::find($id);
        return redirect('admin/users');
    }

    public function detail($id){
        $user =  User::select(['users.*'])
        ->where('id', '=', $id)
        ->first();
        // echo $user->getSql();
        // exit;

        $views = __DIR__."/../../views";
        $cache = __DIR__."/../../cache";
        $blade =  new BladeOne($views, $cache, BladeOne::MODE_AUTO);
        return $blade->run("Admin.product.detail", compact("user"));
    }

    public function destroy($id){
        if(!Authorization::can('delete_any')){
            header('HTTP/1.1 403 Forbidden');
            echo "<script>alert('Bạn không có quyền xóa người dùng!'); window.history.back();</script>";
            exit;
        }

        $userToDelete = User::find($id);
        if($userToDelete->role === 'admin'){
            echo "<script>alert('Không thể xoá tài khoản admin!'); window.history.back();</script>";
            exit;
        }
        User::delete($id);
        return redirect("admin/users");
     }
}