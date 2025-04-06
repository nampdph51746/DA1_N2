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
            @foreach ($reviews as $review )
            <div class="p-4 border rounded-lg shadow-sm">
                <p class="text-gray-700"><strong>{{$review->user->username}}</strong>
                    <p class="text-sm text-gray-500">{{$review->rating}}⭐</p>
                    {{$review->review_text}}</p>
                <p class="text-sm text-gray-500">{{$review->created_at}}</p>
            </div>
            @endforeach
        </div>

        <!-- Form đánh giá -->
        <div class="mt-8">
            <h3 class="text-xl font-semibold text-gray-800">Đánh giá sản phẩm của bạn</h3>
            <form action="{{APP_URL .'reviews/store'}}" method="POST" class="mt-4">
                <input type="hidden" name="product_id" value="{{ $product->id }}" >
                <textarea name="review_text" rows="3" class="w-full p-2 border rounded" placeholder="Viết bình luận..."></textarea>
                <label for="rating" class="block mt-2">Đánh giá:</label>
                <select name="rating" id="rating" class="border p-2 rounded">
                    <option value="5">⭐⭐⭐⭐⭐</option>
                    <option value="4">⭐⭐⭐⭐</option>
                    <option value="3">⭐⭐⭐</option>
                    <option value="2">⭐⭐</option>
                    <option value="1">⭐</option>
                </select>
                <button type="submit" class="mt-2 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Gửi</button>
            </form>
        </div>
    </div>
</div>
@endsection
