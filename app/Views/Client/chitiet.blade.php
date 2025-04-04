@extends('Client.layout')
@section('content')
<div class="max-w-6xl mx-auto p-8 bg-white shadow-lg rounded-2xl border border-gray-200">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
        <!-- Hình ảnh laptop -->
        <div class="relative">
            <!-- Ảnh chính -->
            <img src="{{ APP_URL . $product->image_url }}" alt="{{ $product->product_name }}" class="w-full h-[400px] object-cover rounded-lg shadow-md">
            <span class="absolute top-4 left-4 bg-red-500 text-white text-xs font-bold px-3 py-1 rounded-lg">New</span>

            <!-- Ảnh phụ -->
            <div class="absolute top-4 left-4 transform -translate-x-12 translate-y-12">
                <img src="{{ APP_URL . $product->image_url }}" alt="Ảnh phụ" class="w-24 h-24 object-cover rounded-lg shadow-md border border-gray-300">
                <img src="{{ APP_URL . $product->image_url }}" alt="Ảnh phụ" class="w-24 h-24 object-cover rounded-lg shadow-md border border-gray-300">
                <img src="{{ APP_URL . $product->image_url }}" alt="Ảnh phụ" class="w-24 h-24 object-cover rounded-lg shadow-md border border-gray-300">
            </div>
        </div>
        
        <!-- Thông tin sản phẩm -->
        <div>
            <h2 class="text-4xl font-extrabold text-gray-900">{{ $product->product_name }}</h2>
            <p class="text-lg text-gray-500 mt-2">Thương hiệu: <span class="font-medium text-gray-700">{{ $category->category_name }}</span></p>
            
            <p class="text-3xl text-red-600 font-bold mt-4">Giá:{{ number_format($product->price, 0, ',', '.') }} VND</p>
            <p class="text-black-500">Số lượng:{{$product->stock}}</p>
            <p class="mt-6 text-gray-700 leading-relaxed">{{ $product->description }}</p>
            
            <div class="mt-8 flex space-x-4">
                <button class="bg-blue-600 text-white px-8 py-3 rounded-lg text-lg font-semibold shadow-md hover:bg-blue-700 transition">Mua ngay</button>
                <button class="bg-gray-200 text-gray-700 px-8 py-3 rounded-lg text-lg font-semibold shadow-md hover:bg-gray-300 transition">Thêm vào giỏ</button>
                <a href="{{APP_URL .'sanpham'}}" class="bg-red-500 text-white px-8 py-3 rounded-lg text-lg font-semibold shadow-md hover:bg-red-600 transition">
                    Quay lại
                </a>            
        </div>
    </div>
    
    <!-- Phần bình luận cố định -->
    <div class="mt-12 border-t pt-6">
        <h3 class="text-2xl font-bold text-gray-800">Bình luận</h3>
        <div class="mt-4 space-y-4">
            <div class="p-4 border rounded-lg shadow-sm">
                <p class="text-gray-700"><strong>Admin:</strong> Laptop rất tốt, pin trâu, hiệu năng mạnh.</p>
                <p class="text-sm text-gray-500">★★★★★</p>
            </div>
            <div class="p-4 border rounded-lg shadow-sm">
                <p class="text-gray-700"><strong>Người dùng:</strong> Thiết kế đẹp, màn hình sắc nét.</p>
                <p class="text-sm text-gray-500">★★★★☆</p>
            </div>
            <div class="p-4 border rounded-lg shadow-sm">
                <p class="text-gray-700"><strong>Khách hàng:</strong> Giá hơi cao nhưng đáng tiền.</p>
                <p class="text-sm text-gray-500">★★★★☆</p>
            </div>
        </div>
    </div>
</div>
@endsection
