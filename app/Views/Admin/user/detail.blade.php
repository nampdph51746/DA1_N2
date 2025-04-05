@extends('Admin.layoutadmin')

@section('content')
<main class="p-6 bg-white shadow-lg rounded-lg mx-auto">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">📦 Chi tiết tài khoản</h1>

    <div class="grid grid-cols-2 gap-6">
        <!-- Thông tin chính -->
        <div>
            <img src="{{ APP_URL . 'images/User.png' }}" alt="Hình ảnh sản phẩm" value="Hình ảnh sản phẩm"
                 class="w-full max-w-xs h-auto object-cover rounded-lg shadow-md">
        </div>

        <div>
            <h2 class="text-2xl font-semibold text-gray-900">ID Người dùng: {{ $user->id }}</h2>
            <p class="text-gray-600 mt-2">Tên người dùng: {{ $user->full_name }}</p>
            <p class="text-gray-600 mt-2">Email: {{ $user->email }}</p>
            <p class="text-gray-600 mt-2">SDT: {{ $user->phone }}</p>
            <p class="text-gray-600 mt-2">Role: {{ $user->role }}</p>
            <p class="text-gray-600 mt-2">Trạng thái: {{ $user->status }}</p>
            <p class="text-gray-500 text-sm mt-2">Ngày tạo: {{ $user->created_at }}</p>
            <p class="text-gray-500 text-sm">Cập nhật gần nhất: {{ $user->updated_at }}</p>
            <div class="mt-4">
                <a href="{{APP_URL. 'admin/users/edit/'.$user->id}}" 
                    class="bg-blue-500 text-white px-3 py-1 rounded-md hover:bg-blue-700 transition text-sm inline-flex items-center gap-1 h-8">
                    <span class="text-base leading-none">✏️</span>
                    <span class="leading-none">Sửa</span>
                </a>
            </div>
        </div>
    </div>
</main>
@endsection
