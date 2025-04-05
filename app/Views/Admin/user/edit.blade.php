@extends('Admin.layoutadmin')
@section('content')
<main class="flex-1 p-6 bg-white shadow-lg rounded-lg mx-auto">
    <!-- Nội dung  -->
    <h1 class="text-3xl font-bold text-blue-700 mb-6">➕ Cập nhật thông tin tài khoản</h1>

    <form action="{{APP_URL . 'admin/users/update/' .$user->id}}" method="POST" class="bg-white p-6 rounded-lg shadow-md w-full max-w-lg" enctype="multipart/form-data">
        <input type="hidden" name="id" value="{{ $user->id }}">
        <div class="mb-4">
            <label for="full_name" class="block text-gray-700 font-semibold">Tên người dùng:</label>
            <input type="text" id="full_name" name="full_name" value="{{$user->full_name}}"  
                   class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                   >
        </div>

        <div class="mb-4">
            <label for="email" class="block text-gray-700 font-semibold">Email:</label>
            <input type="text" id="email" name="email" value="{{$user->email}}"  
                   class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                   >
        </div>

        <div class="mb-4">
            <label for="phone" class="block text-gray-700 font-semibold">SDT:</label>
            <input type="text" id="phone" name="phone" value="{{$user->phone}}"  
                   class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                   >
        </div>

        <div class="mb-4">
            <label for="address" class="block text-gray-700 font-semibold">Địa chỉ:</label>
            <input type="text" id="address" name="address" value="{{$user->address}}"  
                   class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                   >
        </div>

        <div class="mb-4">
            <label for="status" class="block text-gray-700 font-semibold">Trạng thái</label>
            
            <select name="status" id="status" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="Đang hoạt động" {{ $user->status == 'Đang hoạt động' ? 'selected' : '' }}>Đang hoạt động</option>
                <option value="Ngừng hoạt động" {{ $user->status == 'Ngừng hoạt động' ? 'selected' : '' }}>Ngừng hoạt động</option>
            </select>
        </div>
    
        <button type="submit" 
                class="bg-blue-700 text-white px-6 py-2 rounded-md font-semibold hover:bg-blue-800 transition">
            💾 Sửa
        </button>
    </form>      
    <!-- End Nội dung -->
</main>
@endsection