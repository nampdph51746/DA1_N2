@extends('Client.layout')

@section('content')
<div class="container mx-auto py-8">
    <h2 class="text-3xl font-bold text-center mb-8 text-gray-800">Danh sách Laptop</h2>

    <!-- Bộ lọc sản phẩm & Form tìm kiếm -->
    <div class="flex flex-col md:flex-row justify-end items-center mb-8 gap-4">
        
        <!-- Form tìm kiếm -->
        <form action="{{APP_URL .'timkiem'}}" method="GET" class="flex w-full md:w-auto ">    
            <input type="text" name="query" placeholder="Tìm kiếm laptop..." 
                class="border border-gray-300 p-2 rounded-l w-full md:w-64 focus:ring-2 focus:ring-blue-500">
            <button type="submit" class="bg-blue-500 text-white px-4 rounded-r hover:bg-blue-700 transition">
                🔍
            </button>
            
        </form>

        
    </div>
    @if(isset($message) && $message != '')
    <p class="text-lg font-semibold text-blue-500">{{ $message }}</p>
@endif
    <!-- Hiển thị sản phẩm -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @foreach ($products as $product)
        <div class="border border-gray-200 rounded-lg shadow-md p-4 hover:shadow-lg transition duration-300">
            <img src="{{APP_URL . $product->image_url}}" alt="" class="w-full h-48 object-cover rounded">
            <h3 class="mt-4 text-lg font-semibold text-gray-800">{{$product->product_name}}</h3>
            <p class="text-gray-500">{{$product->cate_name}}</p>
            <p class="text-gray-500">Số lượng:{{$product->stock}}</p>
            <p class="text-red-500 font-bold text-xl mt-2">{{number_format($product->price)}} VNĐ</p>
            <form action="" method="POST" class="mt-4">
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded w-full hover:bg-blue-600 transition duration-300">
                    Thêm vào giỏ hàng
                </button>
            </form>
            <a href="{{APP_URL .'sanpham/chitiet/'.$product->id}}" class="bg-gray-500 text-white py-2 px-4 rounded w-full block text-center mt-4 hover:bg-gray-600 transition duration-300">
                Xem thêm
            </a>
        </div>
        @endforeach
    </div>
</div>
@endsection
