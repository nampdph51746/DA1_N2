@extends('Admin.layoutadmin')
@section('content')
<main class="flex-1 p-6 bg-white shadow-lg rounded-lg mx-auto">
    <!-- Nội dung  -->
    <h1 class="text-3xl font-bold text-gray-800 mb-4">📦 Danh sách sản phẩm
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
                    <th class="border border-gray-300 px-4 py-2">Số Lượng Tồn Kho</th>
                    <th class="border border-gray-300 px-4 py-2">Danh mục</th>
                    <th class="border border-gray-300 px-4 py-2">Ngày Tạo</th>
                    <th class="border border-gray-300 px-4 py-2">Ngày Cập Nhật</th>
                    <th class="border border-gray-300 px-4 py-2">Mô tả</th>
                    <th class="border border-gray-300 px-4 py-2">Hành động</th>
                </tr>
            </thead>
            <tbody class="bg-white">
                @foreach ($products as $product )
                
                
                <tr class="hover:bg-gray-100">
                    <td class="border border-gray-300 px-4 py-2 text-center">{{$product->id}}</td>
                    <td class="border border-gray-300 px-4 py-2">{{$product->product_name}}</td>
                    <td class="border border-gray-300 px-4 py-2 text-center">
                        <img src="{{APP_URL . $product->image_url}}" alt="" class="w-16 h-16 object-cover rounded-md">
                    </td>
                    <td class="border border-gray-300 px-4 py-2 text-right">{{$product->price}}VNĐ</td>
                    <td class="border border-gray-300 px-4 py-2">{{$product->stock}}</td>
                    <td class="border border-gray-300 px-4 py-2">{{$product->cate_name}}</td>
                    <td class="border border-gray-300 px-4 py-2">{{$product->created_at}}</td>
                    <td class="border border-gray-300 px-4 py-2">{{$product->updated_at}}</td>
                    <td class="border border-gray-300 px-4 py-2">{{$product->description}}</td>
                    <td class="border border-gray-300 px-4 py-2 text-center">
                        <div class="flex justify-center items-center gap-1">
                            <a href="{{APP_URL. 'admin/products/edit/'.$product->id}}" class="bg-blue-500 text-white px-2 py-1 rounded-md hover:bg-blue-700 transition text-sm flex items-center">
                                ✏️Sửa
                            </a>
                            <a href="{{APP_URL. 'admin/products/delete/'.$product->id}}" onclick="return confirmDelete(event)"
                                class="bg-red-500 text-white px-2 py-1 rounded-md hover:bg-red-700 transition text-sm flex items-center">
                                ❌Xóa
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