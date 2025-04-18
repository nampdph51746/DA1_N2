@extends('admin.layoutadmin')

@section('content')
<h2 class="text-2xl font-bold mb-6">📊 Thống kê tổng quan</h2>

<!-- Tổng quan -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
    <div class="bg-white p-6 rounded-xl shadow-md text-center border-t-4 border-blue-500">
        <p class="text-gray-500">Tổng sản phẩm</p>
        <h3 class="text-3xl font-bold">{{ $productCount->total_products }}</h3>
    </div>
    <div class="bg-white p-6 rounded-xl shadow-md text-center border-t-4 border-green-500">
        <p class="text-gray-500">Đã bán</p>
        <h3 class="text-3xl font-bold">{{ $totalSold->total_sold }}</h3>
    </div>
    <div class="bg-white p-6 rounded-xl shadow-md text-center border-t-4 border-yellow-500">
        <p class="text-gray-500">Tổng đơn hàng</p>
        <h3 class="text-3xl font-bold">{{ $orderCount->total_orders }}</h3>
    </div>
    <div class="bg-white p-6 rounded-xl shadow-md text-center border-t-4 border-red-500">
        <p class="text-gray-500">Tổng người dùng</p>
        <h3 class="text-3xl font-bold">{{ $userCount->total_users }}</h3>
    </div>
</div>

<!-- Top 5 sản phẩm bán chạy -->
<h3 class="text-xl font-semibold mb-4">🔥 Top 5 sản phẩm bán chạy</h3>
<ul>
    @foreach($topProducts as $product)
        <table class="w-full border-collapse border border-gray-300 shadow-sm">
            <thead class="bg-gray-200">
                <tr>
                    <th class="border border-gray-300 px-4 py-2">Tên sản phẩm</th>
                    <th class="border border-gray-300 px-4 py-2">Màu sắc</th>
                    <th class="border border-gray-300 px-4 py-2">Hình ảnh</th>
                    <th class="border border-gray-300 px-4 py-2">Đã bán</th>
                    <th class="border border-gray-300 px-4 py-2">Tồn kho</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($product_variants as $variant)
                <tr class="hover:bg-gray-100">
                <td class="border border-gray-300 px-4 py-2 text-center">{{ $variant->variant_name}}</td>
                    <td class="border border-gray-300 px-4 py-2 text-center">{{ $variant->color }}</td>
                    <td class="border border-gray-300 px-4 py-2 text-center">
                        <img src="{{ APP_URL . $variant->image_url }}" class="w-full max-w-xs h-auto object-cover rounded-lg shadow-md">
                    </td>
                    <td class="border border-gray-300 px-4 py-2 text-center">{{ $product->total_sold }}</td>
                    <td class="border border-gray-300 px-4 py-2 text-center">{{ $variant->stock }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @break
    @endforeach
</ul>
@endsection
