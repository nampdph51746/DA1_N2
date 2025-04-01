@extends('Client.layout')

@section('content')
<div class="container mx-auto px-4">
    <h2 class="text-2xl font-bold mb-6 text-center">Danh sách sản phẩm</h2>
    
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @foreach ($products as $product)
            <div class="bg-white shadow-lg rounded-lg p-4 hover:shadow-xl transition">
                <img src="{{ APP_URL . $product->image_url }}" alt="{{ $product->product_name }}" 
                     class="w-full h-48 object-cover rounded-md">
                <h3 class="text-lg font-semibold mt-2">Tên:{{ $product->product_name }}</h3>
                <p class="text-gray-600 text-sm mt-1">Mô tả: {{ $product->description }}</p>
                <p class="text-red-500 font-bold mt-2">Giá: {{ number_format($product->price, 0, ',', '.') }} đ</p>
                <button class="mt-4 w-full bg-blue-500 text-white py-2 rounded-md hover:bg-blue-600">
                   Xem thêm
                </button>
            </div>
        @endforeach
    </div>
</div>
@endsection
