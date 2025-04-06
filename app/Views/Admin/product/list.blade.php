@extends('Admin.layoutadmin')
@section('title','danh sách sản phẩm')
@section('content')
<main class="flex-1 p-6 bg-white shadow-lg rounded-lg mx-auto">
    <!-- Nội dung  -->
      
    <h1 class="text-3xl font-bold text-gray-800 mb-4">📦 Danh sách sản phẩm
    <form action="{{ APP_URL . 'admin/products/search' }}" method="GET" class="space-y-2 my-4">
        <div class="flex flex-wrap gap-2">
            <!-- Tìm theo tên -->
            <input type="text" name="name" placeholder="Tên sản phẩm" class="w-full md:w-1/3 border border-gray-300 rounded px-3 py-2 text-sm" />

            <!-- Tìm theo ID -->
            <input type="number" name="id" placeholder="ID sản phẩm" class="w-full md:w-1/6 border border-gray-300 rounded px-3 py-2 text-sm" />

            <!-- Giá từ -->
            <input type="number" name="price_min" step="1000" placeholder="Giá từ" class="w-full md:w-1/6 border border-gray-300 rounded px-3 py-2 text-sm" />

            <!-- Giá đến -->
            <input type="number" name="price_max" step="1000" placeholder="Giá đến" class="w-full md:w-1/6 border border-gray-300 rounded px-3 py-2 text-sm" />
        </div>

        <div class="flex flex-wrap gap-2">
            <select name="status" class="w-full md:w-1/4 border border-gray-300 rounded px-3 py-2 text-sm">
                <option value="">Tất cả trạng thái</option>
                <option value="Đang bán">Đang bán</option>
                <option value="Ngừng bán">Ngừng bán</option>
            </select>
            <div class="flex justify-end">
                <button type="submit" class="bg-blue-500 text-white px-5 py-2 rounded-full text-sm hover:bg-blue-600 transition">
                    Tìm kiếm
                </button>
                <button type="submit" class="bg-gray-500 text-white px-5 py-2 rounded-full text-sm hover:bg-gray-600 transition">
                    Reset
                <form action="{{APP_URL . 'admin/products/search'}}" method="GET" class="justify-center my-2">
                    <div class="grid grid-cols-3 gap-4 bg-white shadow-sm rounded-lg p-4 border border-gray-300">
                        <!-- ID -->
                        <input type="text" name="id" class="w-full bg-transparent border border-gray-300 px-3 py-1 rounded text-sm focus:outline-none" placeholder="ID">
                        
                        <!-- Tên sản phẩm -->
                        <input type="text" name="product_name" class="w-full bg-transparent border border-gray-300 px-3 py-1 rounded text-sm focus:outline-none" placeholder="Tên sản phẩm">
                        
                        <!-- Giá -->
                        <input type="number" name="price" class="w-full bg-transparent border border-gray-300 px-3 py-1 rounded text-sm focus:outline-none" placeholder="Giá">

                        <!-- Danh mục -->
                        <select name="category_id" class="w-full bg-transparent border border-gray-300 px-3 py-1 rounded text-sm focus:outline-none">
                            <option value="">Chọn danh mục</option>
                            @foreach($categories as $category)
                                <option value="{{$category->id}}">{{$category->category_name}}</option>
                            @endforeach
                        </select>

                        <!-- Ngày tạo -->
                        <input type="date" name="created_at" class="w-full bg-transparent border border-gray-300 px-3 py-1 rounded text-sm focus:outline-none">

                        <!-- Ngày cập nhật -->
                        <input type="date" name="updated_at" class="w-full bg-transparent border border-gray-300 px-3 py-1 rounded text-sm focus:outline-none">

                        <!-- Trạng thái -->
                        <select name="status" class="w-full bg-transparent border border-gray-300 px-3 py-1 rounded text-sm focus:outline-none">
                            <option value="">Tất cả trạng thái</option>
                            <option value="Active">Hoạt động</option>
                            <option value="Deactive">Không hoạt động</option>
                        </select>

                        <!-- Nút tìm kiếm -->
                        <button type="submit" class="bg-blue-500 text-white px-4 py-1 rounded text-sm hover:bg-blue-600 transition">
                            Tìm
                        </button>

                        <!-- Nút làm mới -->
                        <button type="reset" class="bg-gray-400 text-white px-4 py-1 rounded text-sm hover:bg-gray-500 transition">
                            Làm mới
                        </button>
                    </div>
                </div>
            </form>
        <!-- </form> -->
        <div class="mt-4 text-left text-xl">
            <a href="{{APP_URL . 'admin/products/create'}}" class="bg-green-500 text-white px-3 py-1 rounded-md hover:bg-green-700 transition">
                ➕ Thêm sản phẩm
            </a>
        </div>
    </h1>


        <table class="w-full border-collapse border border-gray-300 shadow-sm">
            <thead class="bg-blue-600 text-white">
                <tr>
                    <th class="border border-gray-300 px-4 py-2">ID</th>
                    <th class="border border-gray-300 px-4 py-2">Tên sản phẩm</th>
                    <th class="border border-gray-300 px-4 py-2">Hình ảnh</th>
                    <th class="border border-gray-300 px-4 py-2">Giá</th>
                    <th class="border border-gray-300 px-4 py-2">Danh mục</th>
                    <th class="border border-gray-300 px-4 py-2">Trạng thái</th>
                    <th class="border border-gray-300 px-4 py-2">Ngày Tạo</th>
                    <th class="border border-gray-300 px-4 py-2">Ngày Cập Nhật</th>
                    <th class="border border-gray-300 px-4 py-2">Mô tả</th>
                    <th class="border border-gray-300 px-4 py-2">Trạng thái</th>
                    <th class="border border-gray-300 px-4 py-2">Hành động</th>
                </tr>
            </thead>
            <tbody class="bg-white">
                @foreach ($products as $product )
                
                <tr class="hover:bg-gray-100">
                    <td class="border border-gray-300 px-4 py-2 text-center">{{$product->id}}</td>
                    <td class="border border-gray-300 px-4 py-2">{{$product->product_name}}</td>
                    <td class="border border-gray-300 px-4 py-2 text-center">
                        <img src="{{APP_URL . $product->image_url}}" alt="" class="w-full max-w-xs h-auto object-cover rounded-lg shadow-md">
                    </td>
                    <td class="border border-gray-300 px-4 py-2 text-right">{{$product->price}}VNĐ</td>
                    <td class="border border-gray-300 px-4 py-2">{{$product->cate_name}}</td>
                    <td class="border border-gray-300 px-4 py-2">
                        <span class="font-semibold px-2 py-1 rounded 
                            {{ $product->status == 'Đang bán' ? 'text-green-600 font-bold' : 'text-red-600 font-bold' }}">
                            {{ $product->status }}
                        </span>
                    </td>
                    <td class="border border-gray-300 px-4 py-2">{{$product->created_at}}</td>
                    <td class="border border-gray-300 px-4 py-2">{{$product->updated_at}}</td>
                    <td class="border border-gray-300 px-4 py-2">{{$product->description}}</td>
                    {{-- <td class="border border-gray-300 px-4 py-2">{{$product->description}}</td> --}}
                    <td class="border border-gray-300 px-4 py-2 
                        {{ $product->status === 'Đang bán' ? 'text-green-600 font-bold' : 'text-red-600 font-bold' }}">
                        {{ $product->status }}
                    </td>
                    <td class="border border-gray-300 px-10 py-2 text-center">
                        <div class="flex justify-center items-center gap-1">
                            <a href="{{ APP_URL . 'admin/products/detail/' . $product->id . '?cate_name=' . urlencode($product->cate_name) }}" 
                            class="bg-green-500 text-white px-3 py-1 rounded-md hover:bg-green-700 transition text-sm inline-flex items-center gap-1 h-8">
                                <span class="text-base leading-none">🔍</span>
                                <span class="leading-none">Chi tiết</span>
                            </a>
                            <a href="{{APP_URL. 'admin/products/edit/'.$product->id}}" 
                            class="bg-blue-500 text-white px-3 py-1 rounded-md hover:bg-blue-700 transition text-sm inline-flex items-center gap-1 h-8">
                                <span class="text-base leading-none">✏️</span>
                                <span class="leading-none">Sửa</span>
                            </a>
                            <a href="{{APP_URL. 'admin/products/delete/'.$product->id}}" 
                            onclick="return confirmDelete(event)"
                            class="bg-red-500 text-white px-3 py-1 rounded-md hover:bg-red-700 transition text-sm inline-flex items-center gap-1 h-8">
                                <span class="text-base leading-none">❌</span>
                                <span class="leading-none">Xóa</span>
                            </a>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

<!-- End Nội dung -->
</main>
@endsection