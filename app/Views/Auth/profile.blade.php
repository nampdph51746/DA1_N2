@extends('Client.layout')
@section('content')
<div class="max-w-4xl mx-auto p-6 bg-gray-100 rounded-lg shadow-lg">
    <h1 class="text-3xl font-semibold text-center text-gray-800 mb-6">Thông tin tài khoản của bạn</h1>

    <div class="bg-white p-6 rounded-lg shadow mb-8">
        <h3 class="text-2xl font-semibold text-gray-700 mb-4">Thông tin cá nhân</h3>
        <ul class="list-none space-y-4">
            <li class="text-lg text-gray-700"><strong class="font-semibold">Họ tên:</strong> {{$user->full_name}}</li>
            <li class="text-lg text-gray-700"><strong class="font-semibold">Email:</strong> {{$user->email}}</li>
            <li class="text-lg text-gray-700"><strong class="font-semibold">Số điện thoại:</strong> {{$user->phone}}</li>
            <li class="text-lg text-gray-700"><strong class="font-semibold">Địa chỉ:</strong> {{$user->address}}</li>
        </ul>
    @if($_SESSION['user']->role == 'admin' || $_SESSION['user']->role == 'editor')
    <a href="{{ APP_URL . 'admin/categories' }}"
       class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg shadow hover:bg-green-700 transition duration-200">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-white" fill="none"
             viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M3 7h18M3 12h18M3 17h18"/>
        </svg>
        <span>Trang quản trị</span>
    </a>
@endif
    <a href="{{APP_URL . 'forgot-password'}}"
       class="inline-flex items-center gap-2 px-4 py-2 bg-red-600 text-white text-sm font-medium rounded-lg shadow hover:bg-yellow-700 transition duration-200">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-white" fill="none"
             viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M3 7h18M3 12h18M3 17h18"/>
        </svg>
        <span>Đổi mật khẩu</span>
    </a>
    </div>
    

    <div class="bg-white p-6 rounded-lg shadow">
        <h3 class="text-2xl font-semibold text-gray-700 mb-4">Lịch sử mua hàng</h3>
        <table class="min-w-full table-auto">
            <thead>
                <tr>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700 bg-green-500 text-white">Mã đơn hàng</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700 bg-green-500 text-white">Ngày mua</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700 bg-green-500 text-white">Tổng tiền</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700 bg-green-500 text-white">Trạng thái</th>
                </tr>
            </thead>
            <tbody>
                <tr class="border-t">
                    <td class="px-4 py-2 text-sm text-gray-700">#12345</td>
                    <td class="px-4 py-2 text-sm text-gray-700">2024-03-15</td>
                    <td class="px-4 py-2 text-sm text-gray-700">1.500.000 VNĐ</td>
                    <td class="px-4 py-2 text-sm text-gray-700">Đã giao</td>
                </tr>
                <tr class="border-t">
                    <td class="px-4 py-2 text-sm text-gray-700">#12346</td>
                    <td class="px-4 py-2 text-sm text-gray-700">2024-02-20</td>
                    <td class="px-4 py-2 text-sm text-gray-700">850.000 VNĐ</td>
                    <td class="px-4 py-2 text-sm text-gray-700">Đang vận chuyển</td>
                </tr>
                <tr class="border-t">
                    <td class="px-4 py-2 text-sm text-gray-700">#12347</td>
                    <td class="px-4 py-2 text-sm text-gray-700">2024-01-10</td>
                    <td class="px-4 py-2 text-sm text-gray-700">2.000.000 VNĐ</td>
                    <td class="px-4 py-2 text-sm text-gray-700">Đã giao</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
