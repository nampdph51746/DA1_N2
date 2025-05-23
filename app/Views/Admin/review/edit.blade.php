@extends('Admin.layoutadmin')
@section('content')
<main class="flex-1 p-6 bg-white shadow-lg rounded-lg mx-auto">
    <!-- Nội dung  -->
    <h1 class="text-3xl font-bold text-blue-700 mb-6">✏️ Cập nhật bình luận</h1>

    <form action="{{APP_URL .'admin/reviews/update/' .$review->id}}" 
          method="POST" enctype="multipart/form-data"
          class="bg-white p-6 rounded-lg shadow-md w-full max-w-lg">

        <div class="mb-4">
            <label for="review_status" class="block text-gray-700 font-semibold">Trạng thái</label>
            
            <select name="review_status" id="category_status" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="Hiện" {{ $review->review_status === 'Hiện' ? 'selected' : '' }}>Hiện</option>
                <option value="Ẩn" {{ $review->review_status === 'Ẩn' ? 'selected' : '' }}>Ẩn</option>
            </select>
        </div>
    
        <button type="submit" 
                class="bg-blue-700 text-white px-6 py-2 rounded-md font-semibold hover:bg-blue-800 transition">
            💾 Lưu thay đổi
        </button>
    </form>
    
    
    <!-- End Nội dung -->
</main>
@endsection