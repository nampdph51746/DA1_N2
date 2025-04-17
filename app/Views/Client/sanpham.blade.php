@extends('Client.layout')

@section('content')
<div class="container mx-auto py-8">
    <section class="bg-white py-8 px-6 rounded-lg shadow-lg w-full max-w-screen-xl mx-auto mt-8">
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
                                
    <!-- Hiển thị sản phẩm -->
    <section class="container max-w-screen-xl mx-auto grid grid-cols-12 gap-8 mt-16">
            <!-- Sidebar Categories -->
            <div class="col-span-3">
                    <h2 class="font-semibold text-2xl mb-6 text-black-800">Danh mục sản phẩm</h2>
                    <ul class="space-y-2">
                        <li>
                            <a href="{{ APP_URL . 'sanpham' }}" 
                            class="block p-2 rounded {{ !isset($categoryID) ? 'bg-blue-500 text-white' : 'text-gray-800 hover:bg-gray-100' }}">
                                Tất cả sản phẩm
                            </a>
                        </li>
                        @foreach ($categories as $category)
                        <li>
                            <a href="{{ APP_URL . 'sanpham?category_id=' . $category->id }}" 
                            class="block p-2 rounded {{ isset($categoryID) && $categoryID == $category->id ? 'bg-blue-500 text-white' : 'text-gray-800 hover:bg-gray-100' }}">
                                {{ $category->category_name }}
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>

                <!-- Products List -->
                <div class="col-span-9">
                    @if(isset($message) && $message != '')
                        <p class="text-lg font-semibold text-blue-500">{{ $message }}</p>
                    @endif  
                    <div class="flex justify-between items-center mb-8">
                        <h2 class="font-semibold text-4xl text-black-800">Danh sách sản phẩm</h2>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                        @foreach ($products as $product)
                            <div class="bg-white shadow-lg rounded-lg p-4 hover:shadow-xl transition flex flex-col min-h-[400px]">
                                <!-- Hình ảnh -->
                                <div class="w-full h-48 flex items-center justify-center overflow-hidden rounded-md">
                                    <img src="{{ APP_URL . $product->image_url }}" alt="{{ $product->product_name }}" 
                                        class="w-full h-full object-contain">
                                </div>
                                
                                <!-- Tiêu đề -->
                                <h3 class="text-lg font-semibold mt-2 line-clamp-2">{{ $product->product_name }}</h3>
                                
                                <!-- Mô tả -->
                                <p class="text-gray-600 text-sm mt-1 flex-1 line-clamp-3">{{ $product->description }}</p>
                                
                                <!-- Giá -->
                                <p class="text-red-500 font-bold mt-2">{{ number_format($product->price, 0, ',', '.') }} đ</p>
                                
                                <!-- Nút Xem thêm -->
                                <button type="submit" class="bg-yellow-500 text-white py-2 px-4 rounded w-full hover:bg-yellow-600 transition duration-300">
                                    Thêm vào giỏ hàng
                                </button>
                                <a href="{{APP_URL .'sanpham/chitiet/'.$product->id}}" class="bg-purple-500 text-white py-2 px-4 rounded w-full block text-center mt-4 hover:bg-purple-600 transition duration-300">
                                    Xem thêm
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Pagination -->
            <div class="mt-8 flex justify-center space-x-2">
                <a href="#" class="py-2 px-4 bg-purple-600 text-white font-bold rounded-md">1</a>
                <a href="#" class="py-2 px-4 bg-gray-300 text-gray-700 font-bold rounded-md">2</a>
                <a href="#" class="py-2 px-4 bg-gray-300 text-gray-700 font-bold rounded-md">3</a>
                <a href="#" class="py-2 px-4 bg-purple-600 text-white-700 font-bold rounded-md">Tiếp</a>
            </div>
        </div>
    </section>                          
</div>
@endsection

   