@extends('Client.layout')

@section('content')

<section class="container max-w-screen-xl mx-auto mt-16">
            <div class="flex justify-between items-center mb-4">
                <h2 class="font-semibold text-[40px] relative">
                    Sản phẩm mới
                    <span class="block w-16 h-1 bg-purple-500 mt-2"></span>
                </h2>
                <a href="" 
                class="border border-purple-500 px-4 py-2 font-semibold text-base text-purple-500 hover:bg-purple-500 hover:text-white transition-colors duration-300">
                    Danh sách sản phẩm
                </a>
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
                        <a href="{{APP_URL .'sanpham/chitiet/'.$product->id}}" class="bg-purple-500 text-white py-2 px-4 rounded w-full block text-center mt-4 hover:bg-purple-600 transition duration-300">
                            Xem thêm
                        </a>
                    </div>
                @endforeach
            </div>
        </section>
        <section class="container max-w-screen-xl m-auto mt-16">
            <div class="flex justify-between items-center mb-8">
                <h2 class="font-bold text-4xl text-gray-800 relative">
                    Album Ảnh
                    <span class="block w-16 h-1 bg-purple-500 mt-2"></span>
                </h2>
                <a href="" class="border border-purple-500 px-4 py-2 font-medium text-purple-500 hover:bg-purple-500 hover:text-white transition-colors duration-300">
                    Xem toàn bộ Album
                </a>
            </div>
            <div class="grid grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-6">
                <!-- Ảnh trong gallery -->
                <div class="group overflow-hidden rounded-lg shadow-md hover:shadow-lg">
                    <img loading="lazy" src="{{APP_URL }}/images/gallery_1.jpg" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                </div>
                <div class="group overflow-hidden rounded-lg shadow-md hover:shadow-lg">
                    <img loading="lazy" src="{{APP_URL }}/images/gallery_2.jpg" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                </div>
                <div class="group overflow-hidden rounded-lg shadow-md hover:shadow-lg">
                    <img loading="lazy" src="{{APP_URL }}/images/gallery_3.jpg" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                </div>
                <div class="group overflow-hidden rounded-lg shadow-md hover:shadow-lg">
                    <img loading="lazy" src="{{APP_URL }}/images/gallery_4.png" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                </div>
                <div class="group overflow-hidden rounded-lg shadow-md hover:shadow-lg">
                    <img loading="lazy" src="{{APP_URL }}/images/gallery_5.jpg" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                </div>
                <div class="group overflow-hidden rounded-lg shadow-md hover:shadow-lg">
                    <img loading="lazy" src="{{APP_URL }}/images/gallery_6.jpg" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                </div>
            </div>
        </section>

        <section class="container max-w-screen-xl m-auto mt-16">
            <div class="flex justify-between items-center mb-8">
                <h2 class="font-bold text-4xl text-gray-800 relative">
                    Tin tức
                    <span class="block w-16 h-1 bg-purple-500 mt-2"></span>
                </h2>
                <a href="" class="border border-purple-500 px-4 py-2 font-medium text-purple-500 hover:bg-purple-500 hover:text-white transition-colors duration-300">
                    Xem tất cả tin tức
                </a>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Card Tin Tức -->
                <div class="bg-white rounded-lg shadow-md hover:shadow-lg overflow-hidden">
                    <img loading="lazy" src="{{APP_URL }}/images/news_1.jpg" class="w-full h-48 object-cover">
                    <div class="p-4">
                        <p class="text-gray-400 text-sm flex items-center mb-2">
                            <span class="material-symbols-outlined mr-1">calendar_month</span> 04/04/2025
                        </p>
                        <h3 class="font-semibold text-lg text-gray-800 hover:text-purple-500 transition-colors mb-2">
                            Khuyến Mãi Đặc Biệt: Giảm Giá Đến 50% Cho HSSV!
                        </h3>
                        <a href="" class="text-red-600 font-medium flex items-center group">
                            Xem chi tiết <span class="material-symbols-outlined ml-1 group-hover:translate-x-1 transition-transform">arrow_right_alt</span>
                        </a>
                    </div>
                </div>
        
                <!-- Lặp lại card trên cho các tin tức khác -->
                <div class="bg-white rounded-lg shadow-md hover:shadow-lg overflow-hidden">
                    <img loading="lazy" src="{{APP_URL }}/images/news_2.jpg" class="w-full h-48 object-cover">
                    <div class="p-4">
                        <p class="text-gray-400 text-sm flex items-center mb-2">
                            <span class="material-symbols-outlined mr-1">calendar_month</span> 04/04/2025
                        </p>
                        <h3 class="font-semibold text-lg text-gray-800 hover:text-purple-500 transition-colors mb-2">
                        Top 5 sản phẩm Hot Nhất Mùa Này
                        </h3>
                        <a href="" class="text-red-600 font-medium flex items-center group">
                            Xem chi tiết <span class="material-symbols-outlined ml-1 group-hover:translate-x-1 transition-transform">arrow_right_alt</span>
                        </a>
                    </div>
                </div>
        
                <div class="bg-white rounded-lg shadow-md hover:shadow-lg overflow-hidden">
                    <img loading="lazy" src="{{APP_URL }}/images/news_3.jpg" class="w-full h-48 object-cover">
                    <div class="p-4">
                        <p class="text-gray-400 text-sm flex items-center mb-2">
                            <span class="material-symbols-outlined mr-1">calendar_month</span> 04/04/2025
                        </p>
                        <h3 class="font-semibold text-lg text-gray-800 hover:text-purple-500 transition-colors mb-2">
                        Kinh Nghiệm Mua Laptop Giá Rẻ, Tiện Nghi
                        </h3>
                        <a href="" class="text-red-600 font-medium flex items-center group">
                            Xem chi tiết <span class="material-symbols-outlined ml-1 group-hover:translate-x-1 transition-transform">arrow_right_alt</span>
                        </a>
                    </div>
                </div>
        
                <div class="bg-white rounded-lg shadow-md hover:shadow-lg overflow-hidden">
                    <img loading="lazy" src="{{APP_URL }}/images/news_4.jpg" class="w-full h-48 object-cover">
                    <div class="p-4">
                        <p class="text-gray-400 text-sm flex items-center mb-2">
                            <span class="material-symbols-outlined mr-1">calendar_month</span> 04/04/2025
                        </p>
                        <h3 class="font-semibold text-lg text-gray-800 hover:text-purple-500 transition-colors mb-2">
                        Trải Nghiệm Laptop thế hệ mới nhất
                        </h3>
                        <a href="" class="text-red-600 font-medium flex items-center group">
                            Xem chi tiết <span class="material-symbols-outlined ml-1 group-hover:translate-x-1 transition-transform">arrow_right_alt</span>
                        </a>
                    </div>
                </div>
            </div>
        </section>
@endsection

