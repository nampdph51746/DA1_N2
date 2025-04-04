@extends('Admin.layoutadmin')
@section('content')
<main class="flex-1 p-6 bg-white shadow-lg rounded-lg mx-auto">
    <!-- Nội dung  -->
    <h1 class="text-3xl font-bold text-blue-700 mb-6">➕ Sửa biến thể</h1>

    <form action="{{APP_URL . 'admin/product_variant/update/' .$product_variant->id}}" method="POST" class="bg-white p-6 rounded-lg shadow-md w-full max-w-lg" enctype="multipart/form-data">
        <input type="hidden" name="product_id" value="{{ $product->id }}">

        <div class="mb-4">
            <label for="color" class="block text-gray-700 font-semibold">Màu sắc:</label>
            <input type="text" id="color" name="color" value="{{$product_variant->color}}"  
                   class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                   >
        </div>
    
        <div class="mb-4">
            <label for="image_url" class="block text-gray-700 font-semibold">Hình ảnh:</label>
            <img src="{{APP_URL . $product_variant->image_url}}" alt="" width="90">
            <input type="file" id="image_url" name="image_url"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                   >
        </div>
    
        <div class="mb-4">
            <label for="price" class="block text-gray-700 font-semibold">Giá:</label>
            <input type="text" id="price" name="price" value="{{$product_variant->price}}"
                   class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                   >
        </div>
    
        <div class="mb-4">
            <label for="stock" class="block text-gray-700 font-semibold">Số lượng:</label>
            <input type="text" id="stock" name="stock" value="{{$product_variant->stock}}"
                   class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                   >
        </div>
    
        <button type="submit" 
                class="bg-blue-700 text-white px-6 py-2 rounded-md font-semibold hover:bg-blue-800 transition">
            💾 Sửa
        </button>
    </form>      
    <!-- End Nội dung -->
</main>
@endsection