<?php 
namespace App\Controllers;

use Exception;
use App\Models\Cart;
use App\Models\User;
use App\Models\Cart_Item;
use App\Models\Product_Variant;

class AuthController {
    public function  login(){
        
       return view('Auth.login');
    }
    public function postLogin()
    {
        // Khởi tạo session nếu chưa có
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    
        $data = $_POST;
        $errors = [];
    
        // Kiểm tra dữ liệu đầu vào
        if (trim($data['username'] ?? '') == "" || trim($data['password'] ?? '') == "") {
            $errors['message'] = "Username và mật khẩu phải nhập";
        }
    
        if (!empty($errors)) {
            return view('Auth.login', compact('data', 'errors'));
        }
    
        // Tìm user trong database
        $user = User::where('username', '=', $data['username'])->first();
        if (!$user) {
            $errors['message'] = "Username hoặc mật khẩu không chính xác";
        } else {
            // Kiểm tra mật khẩu
            if (password_verify($data['password'], $user->password)) {
                // Lưu user vào session
                $_SESSION['user'] = $user;
    
                // Đồng bộ giỏ hàng
                try {
                    $this->syncCartWithDatabase($user->id);
                } catch (Exception $e) {
                    // Nếu có lỗi khi đồng bộ giỏ hàng, ghi log và tiếp tục
                    error_log("Lỗi đồng bộ giỏ hàng: " . $e->getMessage());
                }
    
                // Chuyển hướng sau khi đăng nhập thành công
                header('Location: ' . APP_URL);
                exit;
            } else {
                $errors['message'] = "Username hoặc mật khẩu không chính xác";
            }
        }
    
        if (!empty($errors)) {
            return view('Auth.login', compact('data', 'errors'));
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
    
    private function syncCartWithDatabase($userId)
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    
        $sessionCart = $_SESSION['cart'] ?? [];
    
        if (empty($sessionCart)) {
            return; 
        }
    
        $cart = Cart::where('user_id', '=', $userId)->first();
        if (!$cart) {
            Cart::create([
                'user_id' => $userId,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
    
            $cart = Cart::where('user_id', '=', $userId)->first();
            if (!$cart) {
                throw new Exception("Không thể tạo hoặc lấy giỏ hàng cho user_id: $userId");
            }
        }
    
        foreach ($sessionCart as $cartKey => $item) {
            list($productId, $color) = explode('-', $cartKey);
    
            $cartItem = Cart_Item::where('cart_id', '=', $cart->id)
                ->where('product_id', '=', $productId)
                ->where('color', '=', $color)
                ->first();
    
            if ($cartItem) {
                $cartItem->quantity += $item['quantity'];
                $cartItem->save();
            } else {
                Cart_Item::create([
                    'cart_id' => $cart->id,
                    'product_id' => $productId,
                    'color' => $color,
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                ]);
            }
    
            $variant = Product_Variant::where('product_id', '=', $productId)
                ->where('color', '=', $color)
                ->first();
    
            if ($variant && $cartItem->quantity > $variant->stock) {
                $cartItem->quantity = $variant->stock; 
                $cartItem->save();
            }
        }
    
        unset($_SESSION['cart']);
    }
}