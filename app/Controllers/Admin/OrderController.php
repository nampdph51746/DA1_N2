<?php
namespace App\Controllers\Admin;
use App\Models\Order;
use App\Models\Product;
use App\Models\Order_Item;
use eftec\bladeone\BladeOne;
use App\Models\Product_Variant;

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
        ->where('id', '=', $id)
        ->first();
        if(!$order){
            return redirect('/admin/orders');
        }

        $orderItems = Order_Item::select(['order_items.*'])
        ->where('order_id', '=', $id)
        ->get();

        $items = [];
        if(!empty($orderItems)){
            $variantIds = [];
            foreach($orderItems as $item){
                $variantIds[] = $item->variant_id;
            }

            $variants = [];
            foreach($variantIds as $varriantId){
                $variant = Product_Variant::select(['product_variants.*'])
                ->where('id', '=', $varriantId)
                ->first();
                if($variant){
                    $variants[]=$variant;
                }
            }
    
            $varriantMap = array_column($variants, null, 'id');
    
            // $productIds = [];
            // foreach($variants as $variant){
            //     $productIds[]=$variant->product_id;
            // }
    
            // $products = [];
            // foreach($productIds as $productId){
            //     $product = Product::select(['product.*'])
            //     ->where('id', '=', $productId)
            //     ->first();
            //     if($product){
            //         $products[]=$product;
            //     }
            // }
            // $productMap = array_column($products, null, 'id');
    
            foreach($orderItems as $item){
                $variant = $varriantMap[$item->variant_id] ?? null;
    
                $items[] = [
                    'variant_name' => $variant ? $variant->variant_name : 'Unknown',
                    'color' => $item->color,
                    'image_url' => $variant && $variant->image_url ? APP_URL . $variant->image_url : APP_URL. '/images/default.png',
                    'price' => $item->price,
                    'quantity' => $item->quantity
                ];
            }
        }

        $totalQuantity = array_sum(array_column($orderItems, 'quantity'));

        $views = __DIR__."/../../views";
        $cache = __DIR__."/../../cache";
        $blade =  new BladeOne($views, $cache, BladeOne::MODE_AUTO);
        // var_dump($product, $variants);
        return $blade->run("Admin.order.detail", [
            'order' => $order,
            'items' => $items,
            'totalQuantity' => $totalQuantity
        ]);
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