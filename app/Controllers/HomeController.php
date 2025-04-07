<?php
namespace App\Controllers;

use Exception;
use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Review;
use App\Models\Product;
use App\Models\Voucher;
use App\Models\Category;
use App\Models\Cart_Item;
use App\Models\Order_Item;
use App\Models\Product_Variant;
use App\Controllers\Admin\ProductController;

class HomeController {
    public function index(){
        $products =  Product::select(['products.*','categories.category_name as cate_name'])
        ->join('categories','categories.id', 'products.category_id')
        ->limit(4)
        ->get();
        return view('Client.home',compact(var_name: 'products'));
    }
    public function sanpham(){
        $categories = Category::all();
        $categoryID=$_GET['category_id'] ?? null;
        if($categoryID){
           $products= Product::select(['products.*'])
           ->Where('category_id','=',$categoryID)
           ->get();
        }else{
            $products = Product::select(['products.*','categories.category_name as cate_name'])
            ->join('categories','categories.id','products.category_id')
            ->get();
        };
    
     return view('Client.sanpham',compact('products','categories','categoryID'));
    }

    public function chitiet($id){
        $product=Product::find($id);
        $products=Product::select(['products.*','categories.category_name as cate_name'])
        ->join('categories','categories.id','products.category_id')
        ->where('category_id','=',$product->category_id)
        ->andWhere('id','!=',$product->id)
        ->get();
        $category= Category::find($product->category_id);
        $reviews = Review::where('product_id','=', $id)->get();
        foreach($reviews as $review){
            $review->user = User::find($review->user_id);
        }
        $product_variants=Product_Variant::where('product_id','=', $product->id)->get();
        return view('Client.chitiet',compact('product','category','product_variants','products','reviews'));
    }
    public function timkiem(){
        $query = trim($_GET['query'] ?? '');
        $categories = Category::all();
        $products = Product::select(['products.*'])
        ->where('product_name','like','%'.$query.'%')
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
        return view ('Client.sanpham',compact('products','message','categories','query'));
    }

    public function cart(){
        if(session_status() === PHP_SESSION_NONE){
            session_start();
        }

        $user=isset($_SESSION['user']) ? $_SESSION['user'] : null;
        if(!$user){
            return redirect('login');
        }
            $cart=Cart::where('user_id','=',$user->id)->first();
            $cartData=[];
            if($cart){
                $cartItems = Cart_Item::where('cart_id','=',$cart->id)->get();
                foreach($cartItems as $item){
                    $variant=Product_Variant::find($item->variant_id);
                    if($variant){
                        $product=Product::find($variant->product_id);
                    }
                    if($product){
                        $cartKey = $item->variant_id;
                        $cartData[$cartKey]=[
                            'id'=>$item->id,
                            'name'=>$product->product_name,
                            'price'=>$item->price,
                            'color'=>$item->color,
                            'image'=>$variant->image_url,
                            'quantity'=>$item->quantity,
                            'stock'=>$variant->stock
                        ];
                    }
                }
                return view('Client.cart',['cart'=>$cartData]);
            }

        // $cart=$_SESSION['cart'] ?? [];
        return view('Client.cart',['cart'=>[]]);
    }

    public function addToCart(){
        if(session_status() === PHP_SESSION_NONE){
            session_start();
        }

        $user=isset($_SESSION['user']) ? $_SESSION['user'] : null;
        if(!$user){
            return redirect('login');
        }

        $variantId=$_POST['variant_id'] ?? null;
        $color=$_POST['color'] ?? null;
        $quantity=$_POST['quantity'] ?? 1;

        $variant=Product_Variant::find($variantId);
        if(!$variant){
            echo json_encode([
                'success'=>false,
                'message'=>'Sản phẩm không tồn tại!'
            ]);
            exit();
        }

        $product=Product::find($variant->product_id);

        // $variantModel=Product_Variant::where('id','=',$productId)
        // ->andWhere('color','=',$color);
        // ->first();
        // echo $variantModel->getSql();
        // exit;
        // $variant = $variantModel->first();

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
            $cart=Cart::where('user_id','=',$user->id)->first();
            if(!$cart){
                Cart::create([
                    'user_id'=>$user->id,
                    'created_at'=>date('Y-m-d H:i:s'),
                    'updated_at'=>date('Y-m-d H:i:s')
                ]);
                $cart=Cart::where('user_id','=',$user->id)->first();
            }

            $cartItem=Cart_Item::where('cart_id','=',$cart->id)
            ->andWhere('variant_id','=',$variantId)
            ->andWhere('color','=',$color)
            ->first();

            if($cartItem){
                $newQuantity = $cartItem->quantity + $quantity;
                if($newQuantity > $variant->stock){
                    echo json_encode([
                        'success'=>false,
                        'message'=>'Sản phẩm đã hết hàng'
                    ]);
                    exit();
                }
                $cartItem->quantity = $newQuantity;
                Cart_Item::update(['quantity'=>$newQuantity],$cartItem->id);
            }else{
                Cart_Item::create([
                    'cart_id'=>$cart->id,
                    'variant_id'=>$variantId,
                    'color'=>$color,
                    'quantity'=>$quantity,
                    'price'=>$product->price
                ]);
            }
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

        $user = isset($_SESSION['user']) ? $_SESSION['user'] : null;

        if(!$user){
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'message' => 'Vui long dang nhap']);
            exit();
        }

        $variantId=$_POST['cart_key'] ?? null;
        error_log("cartKey: ".$variantId);

        if(!$variantId){
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'message' => 'San pham khong ton tai']);
            exit();
        }

            $cart = Cart::where('user_id', '=', $user->id)->first();
            // error_log("cart: ".print_r($cart, true));

            if (!$cart) {
                header('Content-Type: application/json');
                echo json_encode(['success' => false, 'message' => 'Gio hang khong ton tai']);
                exit();
            }

            // list($color) = explode('-', $variantId);

            $cartItem = Cart_Item::where('cart_id', '=', $cart->id)
            ->andWhere('variant_id', '=', $variantId)
            // ->andWhere('color', '=', $color)
            ->first();
            error_log("cartItem: ".print_r($cartItem, true));

            if(!$cartItem){
                header('Content-Type: application/json');
                echo json_encode(['success' => false, 'message' => 'San pham khong ton tai']);
                exit();
            }

            // $variant=Product_Variant::where('product_id','=',$productId)
            // ->andWhere('color','=',$color)
            // ->first();
            $variant=Product_Variant::find($variantId);

            if($cartItem->quantity + 1 > $variant->stock){
                header('Content-Type: application/json');
                echo json_encode(['success' => false, 'message' => 'Vuot qua so luong ton kho']);
                exit();
            }

            $newQuantity=$cartItem->quantity + 1;
            Cart_Item::update(['quantity'=>$newQuantity],$cartItem->id);

            $updatedCartItem=Cart_Item::find($cartItem->id);

            $cartItems = Cart_Item::where('cart_id', '=', $cart->id)->get();
            $total=array_sum(array_map(function($item){
                return $item->price * $item->quantity;
            },(array)$cartItems));

            header('Content-Type: application/json');
            echo json_encode([
                'success'=>true,
                'message'=>"Đã tăng số lượng",
                'quantity'=>$updatedCartItem->quantity,
                'total'=>$total,
                'color'=>$variant->color
            ]);
            exit();
    }

    public function decreaseQuantity()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    
        $user = isset($_SESSION['user']) ? $_SESSION['user'] : null;

        if(!$user){
            return redirect('login');
        }

        $variantId = $_POST['cart_key'] ?? null;
        error_log("cartKey: ".$variantId);
    
        if (!$variantId) {  
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'message' => 'San pham khong ton tai']);
            exit();
        }
    
            $cart = Cart::where('user_id', '=', $user->id)->first();
            if (!$cart) {
                header('Content-Type: application/json');
                echo json_encode(['success' => false, 'message' => 'Gio hang khong ton tai']);
                exit();
            }
    
            // list($productId, $color) = explode('-', $cartKey);
            $cartItem = Cart_Item::where('cart_id', '=', $cart->id)
                ->andWhere('variant_id', '=', $variantId)
                // ->andWhere('color', '=', $color)
                ->first();
                error_log("cartItem: ".print_r($cartItem, true));
    
            if (!$cartItem) {
                header('Content-Type: application/json');
                echo json_encode(['success' => false, 'message' => 'San pham khong ton tai']);
                exit();
            }
            
            $variant=Product_Variant::find($variantId);
            $newQuantity=$cartItem->quantity-1;
            $message="Đã giảm số lượng";
            if ($newQuantity <= 0) {
                Cart_Item::delete($cartItem->id);
                $message="Đã xoá sản phẩm khỏi giỏ hàng";
                $newQuantity=0;
            }else{
                Cart_Item::update(['quantity'=>$newQuantity],$cartItem->id);
            }

                $cartItems = Cart_Item::where('cart_id', '=', $cart->id)->get();
                $total = array_sum(array_map(function ($item) {
                    return $item->price * $item->quantity;
                }, $cartItems));
    
                header('Content-Type: application/json');
                echo json_encode([
                    'success' => true,
                    'message' => $message,
                    'quantity' => $newQuantity,
                    'total' => $total,
                    'color'=>$variant->color
                ]);
                exit;
            }
    
    public function removeFromCart()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    
        $user = isset($_SESSION['user']) ? $_SESSION['user'] : null;

        if(!$user){
            return redirect('login');
        }

        $variantId=$_POST['cart_key'] ?? null;

        if(!$variantId || strpos($variantId,'-')){
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'message' => 'Gio hang khong hop le']);
            exit();
        }
    
            $cart = Cart::where('user_id', '=', $user->id)->first();
            if ($cart) {
                // list($productId, $color) = explode('-', $key);
                $cartItem = Cart_Item::where('cart_id', '=', $cart->id)
                    ->andWhere('variant_id', '=', $variantId)
                    // ->andWhere('color', '=', $color)
                    ->first();
                if ($cartItem) {
                    Cart_Item::delete($cartItem->id);
                    $cartItems = Cart_Item::where('cart_id', '=', $cart->id)->get();
                    $total = array_sum(array_map(function ($item) {
                        return $item->price * $item->quantity;
                    }, (array)$cartItems));
            
                    header('Content-Type: application/json');
                    echo json_encode([
                        'success' => true,
                        'message' => "Đã xoá san pham khoi gio hang",
                        'total'=>$total
                    ]);
                exit;
                }
            }
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'message' => 'Không tìm thấy sản phẩm để xóa']);
            exit();
    }

    public function applyVoucher()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    
        $user = isset($_SESSION['user']) ? $_SESSION['user'] : null;

        if(!$user){
            return redirect('login');
        }

        $input = file_get_contents('php://input');
        $data = json_decode($input, true);
    
        $voucherCode = $data['voucher_code'] ?? '';
        $cartData = [];
    
            $cart = Cart::where('user_id', '=', $user->id)->first();
            if ($cart) {
                $cartItems = Cart_Item::where('cart_id', '=', $cart->id)->get();
                foreach ($cartItems as $item) {
                    $cartKey = $item->variant_id . '-' . $item->color;
                    $cartData[$cartKey] = [
                        'price' => $item->price,
                        'quantity' => $item->quantity
                    ];
                }
            }
            // if(count($cartItems) === 0 && isset($_SESSION['applied_voucher'])){
            //     unset($_SESSION['applied_voucher']);
            // }
    
        if (empty($cartData)) {
            // if(isset($_SESSION['applied_voucher'])){
            //     unset($_SESSION['applied_voucher']);
            // }
            echo json_encode([
                'success' => false,
                'message' => 'Giỏ hàng trống, không thể áp dụng mã giảm giá'
            ]);
            exit;
        }
    
        $voucher = Voucher::where('code', '=', $voucherCode)->first();
    
        if (!$voucher) {
            echo json_encode([
                'success' => false,
                'message' => 'Mã giảm giá không hợp lệ'
            ]);
            exit;
        }
    
        $currentDate = date('Y-m-d H:i:s');
        if ($voucher->end_date && $voucher->end_date < $currentDate) {
            echo json_encode([
                'success' => false,
                'message' => 'Mã giảm giá đã hết hạn'
            ]);
            exit;
        }
    
        $subtotal = 0;
        foreach ($cartData as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }
    
        $discount = 0;
        if ($voucher->discount_type === 'fixed') {
            $discount = $voucher->discount_value;
        } elseif ($voucher->discount_type === 'percent') {
            $discount = $subtotal * ($voucher->discount_value / 100);
        }
    
        $discount = min($discount, $subtotal);
        $total = max($subtotal - $discount, 0);
    
        $_SESSION['applied_voucher'] = [
            'code' => $voucherCode,
            'discount' => $discount
        ];
    
        echo json_encode([
            'success' => true,
            'message' => 'Áp dụng mã giảm giá thành công',
            'discount' => $discount,
            'total' => $total
        ]);
    }

    public function payment(){
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $user = isset($_SESSION['user']) ? $_SESSION['user'] : null;
        if (!$user) {
            return redirect('login');
        }

        $cartModel = new Cart();
        $cart = Cart::where('user_id', '=', $user->id)->first();

        if(!$cart){
            $cartItems = [];
        }else{
            $cartItemModel = new Cart_Item();
            $cartItems = Cart_Item::where('cart_id','=',$cart->id)->get();
            if(!empty($cartItems)){
                $variantIds = array_column($cartItems,'variant_id');
                file_put_contents('debug.log', "Variant IDs: " . json_encode($variantIds) . "\n", FILE_APPEND);

                $variantModel = new Product_Variant();
                $variants = [];
                foreach($variantIds as $id){
                    $variant = $variantModel->where('id','=',$id)->first();
                    if($variant){
                        $variants[] = $variant;
                    }
                }
                file_put_contents('debug.log', "Variants: " . json_encode($variants) . "\n", FILE_APPEND);

                // $variants = Product_Variant::where('id','=',$variantIds)->get();
                $variantMap = [];
                foreach($variants as $variant){
                    $variantMap[$variant->id] = $variant;
                }
                file_put_contents('debug.log', "Variant Map: " . json_encode($variantMap) . "\n", FILE_APPEND);

                // $productIds = array_column($variants, 'product_id');
                // $products = Product::where('id','=',$productIds)->get();
                // $productMap = [];
                // foreach($products as $product){
                //     $productMap[$product->id] = $product;
                // }

                foreach ($cartItems as $item) {
                    $variantId = property_exists($item, 'variant_id') ? $item->variant_id : null;
                    $variant = $variantId && isset($variantMap[$variantId]) ? $variantMap[$variantId] : null;
                    $item->name = $variant ? $variant->variant_name : 'Unknown';
                    $item->image = $variant ? $variant->image_url : '';
                    $item->color = $variant ? $variant->color : 'N/A';
                    $item->price = $variant ? $variant->price : 0;
                    file_put_contents('debug.log', "Item: variant_id=" . ($variantId ?? 'null') . ", name=" . ($item->name ?? 'null') . ", image=" . ($item->image ?? 'null') . "\n", FILE_APPEND);
                }
            }
        }

        return view('Client.payment',[
            'cart' => $cartItems
        ]);
    }

    public function placeOrder(){
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    
        header('Content-Type: application/json');
        
        $user = isset($_SESSION['user']) ? $_SESSION['user'] : null;
        if (!$user) {
            echo json_encode([
                'success' => false,
                'message' => 'Lỗi: Vui lòng đăng nhập để đặt hàng',
                'debug' => 'Không có user trong session'
            ]);
            exit();
        }
        file_put_contents('debug.log', "User: " . print_r($user, true) . "\n", FILE_APPEND);
    
        $fullname = $_POST['fullname'] ?? '';
        $phone = $_POST['phone'] ?? '';
        $address = $_POST['address'] ?? '';
        $paymentMethod = $_POST['payment_method'] ?? 'cod';
        file_put_contents('debug.log', "Form data: fullname=$fullname, phone=$phone, address=$address, paymentMethod=$paymentMethod\n", FILE_APPEND);
    
        $cart = Cart::where('user_id', '=', $user->id)->first();
        if (!$cart) {
            echo json_encode([
                'success' => false,
                'message' => 'Lỗi: Giỏ hàng trống',
                'debug' => 'Không tìm thấy giỏ hàng cho user_id: ' . $user->id
            ]);
            exit();
        }
        file_put_contents('debug.log', "Cart: " . print_r($cart, true) . "\n", FILE_APPEND);
    
        $cartItems = Cart_Item::where('cart_id', '=', $cart->id)->get();
        if (empty($cartItems)) {
            echo json_encode([
                'success' => false,
                'message' => 'Lỗi: Giỏ hàng trống',
                'debug' => 'Không có sản phẩm trong giỏ hàng với cart_id: ' . $cart->id
            ]);
            exit();
        }
        file_put_contents('debug.log', "Cart Items: " . print_r($cartItems, true) . "\n", FILE_APPEND);
    
        $subtotal = 0;
        foreach ($cartItems as $item) {
            $subtotal += $item->price * $item->quantity;
        }
        file_put_contents('debug.log', "Subtotal: $subtotal\n", FILE_APPEND);
    
        $discount = $_SESSION['applied_voucher']['discount'] ?? 0;
        $totalPrice = max($subtotal - $discount, 0);
        file_put_contents('debug.log', "Discount: $discount, Total Price: $totalPrice\n", FILE_APPEND);
    
        $orderData = [
            'user_id' => $user->id,
            'total_price' => $totalPrice,
            'payment_method' => $paymentMethod,
            'status' => 'pending',
            'fullname' => $fullname,
            'phone' => $phone,
            'address' => $address,
        ];
        file_put_contents('debug.log', "Order Data: " . print_r($orderData, true) . "\n", FILE_APPEND);
    
        try {
            Order::create($orderData);
            file_put_contents('debug.log', "Order created\n", FILE_APPEND);
    
            $order = Order::where('user_id', '=', $user->id)
                ->andWhere('total_price', '=', $totalPrice)
                ->first();
            if (!$order) {
                throw new Exception('Không tìm thấy đơn hàng vừa tạo');
            }
            file_put_contents('debug.log', "Order: " . print_r($order, true) . "\n", FILE_APPEND);
    
            foreach ($cartItems as $item) {
                Order_Item::create([
                    'order_id' => $order->id,
                    'variant_id' => $item->variant_id,
                    'color' => $item->color,
                    'quantity' => $item->quantity,
                    'price' => $item->price,
                ]);
                file_put_contents('debug.log', "Added Order_Item for variant_id: " . $item->variant_id . "\n", FILE_APPEND);
    
                $variant = Product_Variant::find($item->variant_id);
                file_put_contents('debug.log', "Variant for variant_id " . $item->variant_id . ": " . print_r($variant, true) . "\n", FILE_APPEND);
                if ($variant) {
                    $newStock = $variant->stock - $item->quantity;
                    Product_Variant::update(['stock' => $newStock], $variant->id);
                    file_put_contents('debug.log', "Updated stock for variant_id " . $item->variant_id . " to $newStock\n", FILE_APPEND);
                }
            }
    
            foreach ($cartItems as $item) {
                Cart_Item::delete($item->id);
                file_put_contents('debug.log', "Deleted Cart_Item with id: " . $item->id . "\n", FILE_APPEND);
            }
            Cart::delete($cart->id);
            file_put_contents('debug.log', "Deleted Cart with id: " . $cart->id . "\n", FILE_APPEND);
            unset($_SESSION['applied_voucher']);
    
            echo json_encode([
                'success' => true,
                'message' => 'Đặt hàng thành công',
                'redirect' => APP_URL . '/order-confirmation/' . $order->id
            ]);
        } catch (Exception $e) {
            echo json_encode([
                'success' => false,
                'message' => 'Lỗi: Không thể hoàn tất đơn hàng',
                'debug' => 'Lỗi chi tiết: ' . $e->getMessage()
            ]);
        }
        exit();
    }

    public function orderConfirmation($id){
        $order = Order::find($id);
        if(!$order){
            return redirect('/');
        }

        $orderItems = Order_Item::where('order_id', '=', $order->id)->get();
        if(!empty($orderItems)){
            $variantIds = [];
            foreach($orderItems as $item){
                $variantIds[] = $item->variant_id;
            }

            $variants = [];
            foreach($variantIds as $variantId){
                $variant = Product_Variant::where('id', '=', $variantId)->first();
                if($variant){
                    $variants[] = $variant;
                }
            }

            $variantMap = array_column($variants, null, 'id');

            $productIds = [];
            foreach($variants as $variant){
                $productIds[] = $variant->product_id;
            }

            $products = [];
            foreach($productIds as $productId){
                $product = Product::where('id', '=', $productId)->first();
                if($product){
                    $products[] = $product;
                }
            }
            $productMap = array_column($products, null, 'id');

            foreach($orderItems as &$item){
                $variant = $variantMap[$item->variant_id] ?? null;
                $product = $variant ? ($productMap[$variant->product_id] ?? null) : null;
                $item->name = $product ? $product->product_name : 'Unknown';
            }
        }

        return view('Client.order-confirmation',[
            'order' => $order,
            'orderItems' => $orderItems
        ]);
    }
}