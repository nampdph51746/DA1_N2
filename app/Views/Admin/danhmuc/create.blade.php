@extends('Admin.layoutadmin')
@section('content')
<main class="flex-1 p-6 bg-white shadow-lg rounded-lg mx-auto">
    <!-- Nội dung  -->
    <h1 class="text-3xl font-bold text-blue-700 mb-6">➕ Thêm sản phẩm</h1>

    <form action="{{APP_URL .'admin/categories/store'}}" method="POST" class="bg-white p-6 rounded-lg shadow-md w-full max-w-lg" enctype="multipart/form-data">
        
        <div class="mb-4">
            <label for="ten_san_pham" class="block text-gray-700 font-semibold">Tên Danh muc:</label>
            <input type="text" name="category_name"  
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