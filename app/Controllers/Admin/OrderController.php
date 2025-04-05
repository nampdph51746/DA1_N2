<?php
namespace App\Controllers\Admin;
use App\Models\Category;
use App\Models\Order;
use App\Models\User;
use App\Models\Product;
use App\Models\Order_Item;
use App\Models\Cart_Item;
use App\Models\Cart;
use App\Models\Product_Variant;
use eftec\bladeone\BladeOne;
class OrderController {
    public function index(){
        $orders = Order::select(['orders.*', 'users.full_name', "(SELECT GROUP_CONCAT(product_variants.variant_name, ' ',product_variants.color SEPARATOR ', ') 
        FROM order_items 
        JOIN product_variants ON order_items.variant_id = product_variants.id 
        WHERE order_items.order_id = orders.id) as san_pham"
        ])
        ->join('users', 'users.id', 'orders.user_id')
        ->join('order_items', 'order_items.order_id', 'orders.id')
        ->join('product_variants', 'order_items.variant_id', 'product_variants.id')
        ->groupBy("orders.id")
        ->get();
        return view("Admin.order.list",compact("orders"));
    }

    public function updateStatus(){
        $orderId = $_POST['order_id'];
        $order = Order::find($orderId);
        $newStatus=$_POST['status'];
        // $statuses = ['pending', 'processing', 'paid', 'shipped', 'delivered'];
        // if($_POST['action'] === 'update'){
        //     $currentStatusIndex = array_search($order->status, $statuses);
        //     $newStatus = $statuses[$currentStatusIndex + 1];
        // }elseif($_POST['action'] === 'cancel'){
        //     $newStatus = 'cancelled';
        // }

        Order::update(['status' => $newStatus], $orderId);
        // return view("Admin.order.list",compact("order"));
        header("Location: http://localhost/DA1_N2-main/admin/orders");
        exit();
    }

    public function detail($id){
        $id = (int)$id;
        $order = Order::select(['orders.*'])
        // ->join('users', 'users.id', 'orders.user_id')
        ->where('id', '=', $id)
        ->first();
        $order->full_name = $_GET['full_name'];
        // echo $order->getSql();
        // exit;

        $variants = Product_Variant::select(['product_variants.*'])
        ->join('order_items', 'order_items.variant_id', 'product_variants.id')
        // ->where('id', '=', $id);
        ->get();
        // echo $variants->getSql();
        // exit;

        // $variants = Product_Variant::where('order_id', '=', $id)->get();

        $views = __DIR__."/../../views";
        $cache = __DIR__."/../../cache";
        $blade =  new BladeOne($views, $cache, BladeOne::MODE_AUTO);
        // var_dump($product, $variants);
        return $blade->run("Admin.order.detail", compact("order", "variants"));
    }

    public function search(){
        $query=trim($_GET['name'] ?? '');
        $id=trim($_GET['id'] ?? '');
        $price_min=trim($_GET['price_min'] ?? '');
        $price_max=trim($_GET['price_max'] ?? '');
        $created_at=trim($_GET['created_at'] ?? '');
        $updated_at=trim($_GET['updated_at'] ?? '');
        $status=trim($_GET['status'] ?? '');

        $hasWhere=false;
        $orders=null;

        if($query !== ''){
            $orders = Order::where('full_name','LIKE',"%$query%");
            $hasWhere=true;
        }

        if($id !== ''){
            if($hasWhere){
                $orders->andWhere('id','=',$id);
            }else{
                $orders=Order::where('id','=',$id);
                $hasWhere=true;
            }
        }

        if($price_min !== ''){
            if($hasWhere){
                $orders->andWhere('total_price','>=',$price_min);
            }else{
                $orders=Order::where('total_price','>=',$price_min);
                $hasWhere=true;
            }
        }

        if($price_max !== ''){
            if($hasWhere){
                $orders->andWhere('total_price','<=',$price_max);
            }else{
                $orders=Order::where('total_price','<=',$price_max);
                $hasWhere=true;
            }
        }

        if($created_at !== ''){
            if($hasWhere){
                $orders->andWhere('created_at','=',$created_at);
            }else{
                $orders=Order::where('created_at','=',$created_at);
                $hasWhere=true;
            }
        }

        if($updated_at !== ''){
            if($hasWhere){
                $orders->andWhere('updated_at','=',$updated_at);
            }else{
                $orders=Order::where('updated_at','=',$updated_at);
                $hasWhere=true;
            }
        }

        if($status !== ''){
            if($hasWhere){
                $orders->andWhere('status','=',$status);
            }else{
                $orders=Order::where('status','=',$status);
                $hasWhere=true;
            }
        }

        if(!$hasWhere){
            $orders=Order::all();
        }else{
            $orders=$orders->get();
        }
        return view("Admin.order.list",compact('orders'));
    }
}