@extends('Admin.layoutadmin')
@section('content')
<main class="flex-1 p-6 bg-white shadow-lg rounded-lg mx-auto">
    <!-- Nội dung  -->
    <h1 class="text-3xl font-bold text-blue-700 mb-6">➕ Sửa sản phẩm</h1>

    <form action="{{APP_URL . 'admin/products/update/' .$product->id}}" method="POST" class="bg-white p-6 rounded-lg shadow-md w-full max-w-lg" enctype="multipart/form-data">
        
        <div class="mb-4">
            <label for="product_name" class="block text-gray-700 font-semibold">Tên sản phẩm:</label>
            <input type="text" id="product_name" name="product_name" value="{{$product->product_name}}"  
                   class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                   >
        </div>
        <div class="mb-4">
            <label for="stock" class="block text-gray-700 font-semibold">Số lượng:</label>
            <input type="number" id="stock" name="stock" value="{{$product->stock}}" 
                   class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                   >
        </div>
    
        <div class="mb-4">
            <label for="image_url" class="block text-gray-700 font-semibold">Hình ảnh:</label>
            <img src="{{APP_URL . $product->image_url}}" alt="" width="90">
            <input type="file" id="image_url" name="image_url"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                   >
        </div>
        <div class="mb-4">
            <label for="">Thương hiệu</label>
            
            <select name="category_id" id="category_id" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                 @foreach ($categories as $cate )
                 <option value="{{$cate->id}}" @selected($cate->id == $product->category_id)>
                    
                       {{$cate->category_name}}
                 </option>
                 @endforeach   
            </select>
        </div>
    
        <div class="mb-4">
            <label for="price" class="block text-gray-700 font-semibold">Giá:</label>
            <input type="text" id="price" name="price" value="{{$product->price}}"
                   class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                   >
        </div>
    
        <div class="mb-4">
            <label for="description" class="block text-gray-700 font-semibold">Mô tả:</label>
            <textarea id="description" name="description"
                      class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                      >{{$product->description}}</textarea>
        </div>
    
        <button type="submit" 
                class="bg-blue-700 text-white px-6 py-2 rounded-md font-semibold hover:bg-blue-800 transition">
            💾 Sửa
        </button>
    </form>      
    <!-- End Nội dung -->
</main>
@endsection