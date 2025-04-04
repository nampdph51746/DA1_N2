@extends('Admin.layoutadmin')
<<<<<<< HEAD
=======
@section('title','danh sách sản phẩm')
>>>>>>> c75c26ae0461b1967aa5ecfee11482330c96b269
@section('content')
<main class="flex-1 p-6 bg-white shadow-lg rounded-lg mx-auto">
    <!-- Nội dung  -->
      
    <h1 class="text-3xl font-bold text-gray-800 mb-4">📦 Danh sách sản phẩm
        <form action="{{APP_URL . 'admin/products/search'}}" method="GET" class=" justify-center my-2">
            <div class="flex items-center bg-white shadow-sm rounded-full max-w-xs px-3 py-1 border border-gray-300">
                <input type="text" name="query" class="w-full bg-transparent focus:outline-none text-sm px-2" placeholder="Nhập từ khóa...">
                <button type="submit" class="bg-blue-500 text-white px-4 py-1 rounded-full text-sm hover:bg-blue-600 transition">
                    Tìm
                </button>
            </div>
        </form>
        
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
                    <th class="border border-gray-300 px-4 py-2">Ngày Tạo</th>
                    <th class="border border-gray-300 px-4 py-2">Ngày Cập Nhật</th>
<<<<<<< HEAD
                    <th class="border border-gray-300 px-4 py-2">Mô tả</th>
=======
                    {{-- <th class="border border-gray-300 px-4 py-2">Mô tả</th> --}}
>>>>>>> c75c26ae0461b1967aa5ecfee11482330c96b269
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
                    <td class="border border-gray-300 px-4 py-2">{{$product->created_at}}</td>
                    <td class="border border-gray-300 px-4 py-2">{{$product->updated_at}}</td>
<<<<<<< HEAD
                    <td class="border border-gray-300 px-4 py-2">{{$product->description}}</td>
=======
                    {{-- <td class="border border-gray-300 px-4 py-2">{{$product->description}}</td> --}}
>>>>>>> c75c26ae0461b1967aa5ecfee11482330c96b269
                    <td class="border border-gray-300 px-10 py-2 text-center">
                        <div class="flex justify-center items-center gap-1">
                            <a href="{{APP_URL. 'admin/products/detail/'.$product->id}}" 
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