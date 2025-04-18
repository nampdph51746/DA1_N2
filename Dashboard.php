<?php
namespace App\Controllers\Admin;
use App\Models\Product_Variant;
use App\Models\ProductVariant;
use App\Models\Product;
use App\Models\Order;
use App\Models\Order_Item;
use App\Models\User;

class Dashboard {
    public function index() {
        // Đếm tổng số sản phẩm
        $productCount = Product::select(['COUNT(*) as total_products'])->first();

        // Tổng số lượng sản phẩm đã bán
        $totalSold = Order_Item::select(['SUM(quantity) as total_sold'])->first();

        // Tổng số đơn hàng
        $orderCount = Order::select(['COUNT(*) as total_orders'])->first();

        // Tổng số người dùng
        $userCount = User::select(['COUNT(*) as total_users'])->first();


        // Top 5 sản phẩm bán chạy nhất
        $topProducts = Order_Item::select(['variant_id', 'SUM(quantity) as total_sold'])
            ->groupBy('variant_id')
            ->orderBy('total_sold', 'DESC')
            ->limit(5)
            ->get();

        $product_variants =  Product_Variant::select(['product_variants.*'])
        ->get();

        // Gửi dữ liệu sang view
        return view('admin.dashboard.index', compact('productCount', 'totalSold', 'orderCount', 'userCount',  'topProducts','product_variants'));
    }
}
?>
