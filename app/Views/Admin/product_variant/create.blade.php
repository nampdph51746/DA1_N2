@extends('Admin.layoutadmin')
@section('content')
<main class="flex-1 p-6 bg-white shadow-lg rounded-lg mx-auto">
    <!-- Nội dung  -->
    <h1 class="text-3xl font-bold text-blue-700 mb-6">➕ Thêm biến thể</h1>
    <h2 class="text-xl font-semibold text-gray-800 mb-4">
        Biến thể của sản phẩm: <span class="text-blue-600">{{ $product->product_name }}</span>
    </h2>

    <form action="{{APP_URL . 'admin/product_variant/store'}}" method="POST" class="bg-white p-6 rounded-lg shadow-md w-full max-w-lg" enctype="multipart/form-data">
        <input type="hidden" name="product_id" value="{{ $product->id }}">

        <div class="mb-4">
            <label for="color" class="block text-gray-700 font-semibold">Màu sắc:</label>
            <input type="text" id="color" name="color"  
                   class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                   >
        </div>
    
        <div class="mb-4">
            <label for="image_url" class="block text-gray-700 font-semibold">Hình ảnh:</label>
            <input type="file" id="image_url" name="image_url"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                   >
        </div>

        <div class="mb-4">
            <label for="stock" class="block text-gray-700 font-semibold">Số lượng:</label>
            <input type="text" id="stock" name="stock" 
                   class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                   >
        </div>
    
        <div class="mb-4">
            <label for="price" class="block text-gray-700 font-semibold">Giá:</label>
            <input type="text" id="price" name="price" 
                   class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                   >
        </div>
    
        <button type="submit" 
                class="bg-blue-700 text-white px-6 py-2 rounded-md font-semibold hover:bg-blue-800 transition">
            💾 Thêm
        </button>
    </form>      
    <!-- End Nội dung -->
</main>
@endsection