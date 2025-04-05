@extends('Admin.layoutadmin')

@section('content')
<main class="p-6 bg-white shadow-lg rounded-lg mx-auto">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">📦 Chi tiết bình luận</h1>

    <div class="grid grid-cols-2 gap-6">
        <!-- Thông tin chính -->
        <div>
            <img src="{{ APP_URL . 'images/Review.png' }}"
                 class="w-full max-w-xs h-auto object-cover rounded-lg shadow-md">
        </div>

        <div>
            <h2 class="text-2xl font-semibold text-gray-900">ID: {{ $review->id }}</h2>
            <p class="text-gray-600 mt-2">Sản phẩm bình luận: {{ $review->product_id}}</p>
            <p class="text-gray-600 mt-2">Người bình luận: {{ $review->user_id }}</p>
            <p class="text-gray-600 mt-2">Đánh giá: {{ $review->rating }}</p>
            <p class="text-gray-600 mt-2">Nội dung: {{ $review->review_text }}</p>
            <p class="text-gray-600 mt-2">
                Trạng thái: 
                <span class="
                    {{ $review->review_status === 'Hiện' ? 'text-green-500 font-bold' : '' }}
                    {{ $review->review_status === 'Ẩn' ? 'text-red-500 font-bold' : '' }}">
                    {{ $review->review_status }}
                </span>
            </p>
            <p class="text-gray-500 text-sm mt-2">Ngày bình luận: {{ $review->created_at }}</p>
            <p class="text-gray-500 text-sm">Cập nhật gần nhất: {{ $review->updated_at }}</p>
            <div class="mt-4">
                <a href="{{ APP_URL . 'admin/reviews/edit/' . $review->id }}" 
                   class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition">
                    ✏️ Sửa bình luận
                </a>
                <!-- <a href="{{ APP_URL . 'admin/products/delete/' . $product->id }}" 
                   onclick="return confirm('Bạn có chắc muốn xóa sản phẩm này?')"
                   class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-700 transition ml-2">
                    ❌ Xóa sản phẩm
                </a> -->
            </div>
        </div>
    </div>
</main>
@endsection
