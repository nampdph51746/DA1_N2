<?php
namespace App\Controllers;

use App\Controllers\Admin\ProductController;
use App\Models\Category;
use App\Models\Product;
use App\Models\Product_Variant;
use App\Models\Voucher;

class HomeController {
    public function index(){
        $products =  Product::select(['products.*','categories.category_name as cate_name'])
        ->join('categories','categories.id', 'products.category_id')
        ->limit(4)
        ->get();
        return view('Client.home',compact(var_name: 'products'));
    }
    public function sanpham(){
     $products = Product::select(['products.*','categories.category_name as cate_name'])
     ->join('categories','categories.id','products.category_id')
     ->get();
     return view('Client.sanpham',compact('products'));
    }
    public function chitiet($id){
        $product=Product::find($id);
        $products=Product::select(['products.*','categories.category_name as cate_name'])
        ->join('categories','categories.id','products.category_id')
        ->where('category_id','=',$product->category_id)
        ->andWhere('id','!=',$product->id)
        ->get();
        $category= Category::find($product->category_id);
        $product_variants=Product_Variant::where('product_id','=', $product->id)->get();
        return view('Client.chitiet',compact('product','category','product_variants','products'));
    }
    public function timkiem(){
        $query = trim($_GET['query'] ?? '');
        $products = Product::where('product_name','LIKE','%'.''.$query.'%')
        ->get();
        $message = '';
        if($query !=''){
            $message = 'Kết quả tìm kiếm cho từ khóa: '.$query;
            if(count($products)==0){
                $message ='không tìm thấy kết quả cho từ khóa: '.$query;
            }
        }else{
            $message = 'Vui lòng nhập từ khóa tìm kiếm';
        }
        return view ('Client.sanpham',compact('products','message'));
    }

    public function cart(){
        if(session_status() === PHP_SESSION_NONE){
            session_start();
        }

        $cart=$_SESSION['cart'] ?? [];
        return view('Client.cart',compact('cart'));
    }

    public function addToCart(){
        if(session_status() === PHP_SESSION_NONE){
            session_start();
        }

        $productId=$_POST['product_id'] ?? null;
        $color=$_POST['color'] ?? null;
        $quantity=$_POST['quantity'] ?? 1;

        $product=Product::find($productId);
        if(!$product){
            echo json_encode([
                'success'=>false,
                'message'=>'Sản phẩm không tồn tại!'
            ]);
        }

        $variantModel=Product_Variant::where('product_id','=',$productId)
        ->andWhere('color','=',$color);
        // ->first();
        // echo $variantModel->getSql();
        // exit;
        $variant = $variantModel->first();

        // echo "SQL: ".$variantModel->getSqlBuilder()."</br>";
        // echo "Params: ";
        // var_dump($variantModel->getParams());
        // echo "Variant: ";
        // var_dump($variant);

        if(!$variant || $variant->stock < $quantity){
            echo json_encode([
                'success'=>false,
                'message'=>'Sản phẩm đã hết hàng!'
            ]);
            exit();
        }

        // var_dump($variant->image_url);

        $cart=$_SESSION['cart']??[];
        $cartKey=$productId.'-'.$color;

        if(isset($cart[$cartKey])){
            $cart[$cartKey]['quantity'] += $quantity;
        }else{
            $cart[$cartKey]=[
                'id'=>$product->id,
                'name'=>$product->product_name,
                'price'=>$product->price,
                'color'=>$variant->color,
                'image'=>$variant->image_url,
                'quantity'=>$quantity,
                'stock'=>$variant->stock
            ];
        }

        if($cart[$cartKey]['quantity'] > $variant->stock){
            echo json_encode([
                'success'=>false,
                'message'=>'Sản phẩm đã hết hàng!'
            ]);
            exit();
        }

        $_SESSION['cart']=$cart;

        echo json_encode([
            'success'=>true,
            'message'=>'Đã thêm vào giỏ hàng!'
        ]);
        exit();
    }

    public function increaseQuantity(){
        if(session_status() === PHP_SESSION_NONE){
            session_start();
        }

        $cartKey=$_POST['cart_key'] ?? null;

        if(!$cartKey||!isset($_SESSION['cart'][$cartKey])){
            header('Location: '.APP_URL.'/sanpham?error=San pham khong ton tai');
            exit();
        }

        $cart=$_SESSION['cart'];
        $item=$cart[$cartKey];

        list($productId,$color)=explode('-',$cartKey);
        $variantModel=Product_Variant::where('product_id','=',$productId)
        ->andWhere('color','=',$color);
        $variant = $variantModel->first();

        if($item['quantity'] + 1 > $variant->stock){
            echo "<script>alert('Vượt quá số lượng tồn kho!'); window.location.href = '".APP_URL."/cart';</script>";
            exit();
        }

        $cart[$cartKey]['quantity'] += 1;
        $_SESSION['cart']=$cart;

        header('Content-Type: application/json');
        echo json_encode([
            'success'=>true,
            'message'=>"Đã tăng số lượng",
            'quantity'=>$cart[$cartKey]['quantity'],
            'total'=>array_sum(array_map(function($item){
                return $item['price']*$item['quantity'];
            },$cart))
        ]);
        exit();
    }

    public function decreaseQuantity(){
        if(session_status() === PHP_SESSION_NONE){
            session_start();
        }

        $cartKey=$_POST['cart_key'] ?? null;

        if(!$cartKey||!isset($_SESSION['cart'][$cartKey])){
            header('Location: '.APP_URL.'/sanpham?error=San pham khong ton tai');
            exit();
        }

        $cart=$_SESSION['cart'];
        $item=$cart[$cartKey];

        $cart[$cartKey]['quantity'] -= 1;
        if($cart[$cartKey]['quantity'] <= 0){
            unset($cart[$cartKey]);
            $_SESSION['cart']=$cart;
            header('Content-Type: application/json');
            echo json_encode([
                'success'=>true,
                'message'=>"Đã xoá số lượng",
                'quantity'=>0,
                'total'=>array_sum(array_map(function($item){
                    return $item['price']*$item['quantity'];
                },$cart))
            ]);
        }

        $_SESSION['cart']=$cart;

        header('Content-Type: application/json');
        echo json_encode([
            'success'=>true,
            'message'=>"Đã giảm số lượng",
            'quantity'=>$cart[$cartKey]['quantity'],
            'total'=>array_sum(array_map(function($item){
                return $item['price']*$item['quantity'];
            },$cart))
        ]);
        exit();
    }
    
    public function removeFromCart($key){
        if(session_status() === PHP_SESSION_NONE){
            session_start();
        }

        $cart=$_SESSION['cart']??[];
        if(isset($cart[$key])){
            unset($cart[$key]);
            $_SESSION['cart']=$cart;
        }

        header('Location: '.APP_URL.'/cart?success=Da xoa san pham khoi gio hang');
        exit();
    }

    public function applyVoucher(){
        if(session_status() === PHP_SESSION_NONE){
            session_start();
        }

        $input=file_get_contents('php://input');
        $data=json_decode($input,true);

        $voucherCode=$data['voucher_code'] ?? '';
        $cart=$data['cart'] ?? '';

        if(empty($cart)){
            echo json_encode([
                'success'=>false,
                'message'=>'Giỏ hàng trống, không thể áp dụng mã giảm giá'
            ]);
            exit();
        }

        $voucher=Voucher::where('code','=',$voucherCode)->first();

        if(!$voucher){
            echo json_encode([
                'success'=>false,
                'message'=>'Mã giảm giá không hợp lệ'
            ]);
            return;
        }

        $currentDate=date('Y-m-d H:i:s');
        if($voucher->end_date && $voucher->end_date < $currentDate){
            echo json_encode([
                'success'=>false,
                'message'=>'Mã giảm giá đã hết hạn'
            ]);
            exit();
        }

        $subtotal=0;
        foreach($cart as $item){
            $subtotal+=$item['price']*$item['quantity'];
        }

        $discount=0;
        if($voucher->discount_type === 'fixed'){
            $discount=$voucher->discount_value;
        }elseif($voucher->discount_type === 'percent'){
            $discount=$subtotal*($voucher->discount_value/100);
        }

        $discount=min($discount,$subtotal);
        $total=max($subtotal-$discount,0);

        $_SESSION['applied_voucher']=[
            'code'=>$voucherCode,
            'discount'=>$discount
        ];

        echo json_encode([
            'success'=>true,
            'message'=>'Áp dụng mã giảm giá thành công',
            'discount'=>$discount,
            'total'=>$total
        ]);
    }
}