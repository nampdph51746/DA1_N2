@extends('Admin.layoutadmin')

@section('content')
<main class="p-6 bg-white shadow-lg rounded-lg mx-auto">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">📦 Chi tiết sản phẩm</h1>

    <div class="grid grid-cols-2 gap-6">
        <!-- Thông tin chính -->
        <div>
            <img src="{{ APP_URL . $product->image_url }}" alt="Hình ảnh sản phẩm"
                 class="w-full max-w-xs h-auto object-cover rounded-lg shadow-md">
        </div>

        <div>
            <h2 class="text-2xl font-semibold text-gray-900">{{ $product->product_name }}</h2>
            <p class="text-gray-600 mt-2">{{ $product->description }}</p>
            <p class="mt-4 text-lg font-bold text-red-600">Giá: {{ number_format($product->price) }} VNĐ</p>
            <p class="text-gray-700 mt-2">Danh mục: <span class="font-semibold">{{$product->cate_name}}</span></p>
            <p class="text-gray-500 text-sm mt-2">Ngày tạo: {{ $product->created_at }}</p>
            <p class="text-gray-500 text-sm">Cập nhật gần nhất: {{ $product->updated_at }}</p>

            <div class="mt-4">
                <a href="{{ APP_URL . 'admin/products/edit/' . $product->id }}" 
                   class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition">
                    ✏️ Sửa sản phẩm
                </a>
                <a href="{{ APP_URL . 'admin/products/delete/' . $product->id }}" 
                   onclick="return confirm('Bạn có chắc muốn xóa sản phẩm này?')"
                   class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-700 transition ml-2">
                    ❌ Xóa sản phẩm
                </a>
            </div>
        </div>
    </div>

    <!-- Danh sách biến thể sản phẩm -->
    <div class="mt-8">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4">🎨 Biến thể sản phẩm
            <div class="mt-4 text-left text-xl">
                <a href="{{APP_URL . 'admin/product_variant/create/' .$product->id}}" class="bg-green-500 text-white px-3 py-1 rounded-md hover:bg-green-700 transition">
                    ➕ Thêm biến thể
                </a>
            </div>
        </h2>
        
        <table class="w-full border-collapse border border-gray-300 shadow-sm">
            <thead class="bg-gray-200">
                <tr>
                    <th class="border border-gray-300 px-4 py-2">Màu sắc</th>
                    <th class="border border-gray-300 px-4 py-2">Hình ảnh</th>
                    <th class="border border-gray-300 px-4 py-2">Giá</th>
                    <th class="border border-gray-300 px-4 py-2">Tồn kho</th>
                    <th class="border border-gray-300 px-4 py-2">Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($variants as $variant)
                <tr class="hover:bg-gray-100">
                    <td class="border border-gray-300 px-4 py-2 text-center">{{ $variant->color }}</td>
                    <td class="border border-gray-300 px-4 py-2 text-center">
                        <img src="{{ APP_URL . $variant->image_url }}" class="w-full max-w-xs h-auto object-cover rounded-lg shadow-md">
                    </td>
                    <td class="border border-gray-300 px-4 py-2 text-center">{{ number_format($variant->price) }} VNĐ</td>
                    <td class="border border-gray-300 px-4 py-2 text-center">{{ $variant->stock }}</td>
                    <td class="border border-gray-300 px-4 py-2 text-center">
                        <a href="{{ APP_URL . 'admin/product_variant/edit/' . $variant->id }}" 
                           class="bg-yellow-500 text-white px-2 py-1 rounded-md hover:bg-yellow-700 transition text-sm">
                            ✏️ Sửa
                        </a>
                        <a href="{{ APP_URL . 'admin/product_variant/delete/' . $variant->id }}" 
                           onclick="return confirm('Bạn có chắc muốn xóa biến thể này?')"
                           class="bg-red-500 text-white px-2 py-1 rounded-md hover:bg-red-700 transition text-sm">
                            ❌ Xóa
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</main>
@endsection
