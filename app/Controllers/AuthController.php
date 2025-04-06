<?php 
namespace App\Controllers;

use App\Models\User;

class AuthController {
    public function  login(){
        
       return view('Auth.login');
    }
    public function postLogin(){
        $data= $_POST;
        if(trim($data['username'])=="" || trim($data['password'])==""){
            $errors['message']="Usename và mật khẩu phải nhập";
        }
        if(isset($errors)){
            return view('Auth.login',compact('data', 'errors'));
        }
        $user = User::where('username','=',$data['username'])->first();
        if(!$user){
            $errors['message'] ="Username hoặc mật khẩu không chính xác";
        }else{
            if(password_verify($data['password'],$user->password)){
                $_SESSION['user']=$user;
                return redirect('');
            }else{
                $errors['message'] ="Username hoặc mật khẩu không chính xác";
            }
        }
        if(isset($errors)){
            return view('Auth.login',compact('data', 'errors'));
        }
    }
    public function  register(){
        return view('Auth.register');
    }
    public function  store(){
        $data = $_POST;
        // mã hóa
        $data['password']=password_hash($data['password'],PASSWORD_DEFAULT);
        User::create($data);
        return redirect('login');
    }
   public function logout(){
    if(isset($_SESSION['user'])){
        unset($_SESSION['user']);
        return redirect('login');
    }
    }
    public function profile(){
        if(!isset($_SESSION['user'])){
            return view('Auth.login');
        }
        $user = $_SESSION['user'];
        return view('Auth.profile',compact('user'));
    }
    //quên mật khẩu
    public function forgotPasswordForm(){

        return view('Auth.forgot_password');
    }
    public function handleForgotPassword(){
           $email= trim($_POST['email']);
           $phone = trim($_POST['phone']);
           $user = User::where('email','=',$email)
           ->andWhere('phone','=',$phone)
           ->first();
           if($user){
            $_SESSION['reset_user_id'] =$user->id;
            return redirect('reset-password');
           }else{
            $error = "Email hoặc số điện thoại không chính xác";
            return view ('Auth.forgot_password',compact('error'));
           }
    }
    public function showResetPasswordForm(){
        if(!isset($_SESSION['reset_user_id'])){
            return redirect('forgot-password');
        }
        return view ('Auth.reset_password');
    }
    public function handleResetPassword(){
        if(!isset($_SESSION['reset_user_id'])){
            return redirect('forgot-password');
        }
        $password = trim($_POST['password']);
        $password_confirmation = trim($_POST['password_confirmation']);
        if($password != $password_confirmation){
            $error ='Mật khẩu và mật khẩu xác nhận không khớp';
            return view('Auth.reset_password',compact('error'));
        }
        $userID=$_SESSION['reset_user_id'];
        User::update(['password'=>password_hash($password,PASSWORD_DEFAULT)],$userID);
        unset($_SESSION['reset_user_id']);
        return redirect('login');
    }
    
}