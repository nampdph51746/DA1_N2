@extends('Client.layout')
@section('content')
<div class="max-w-4xl mx-auto p-6 bg-gray-100 rounded-lg shadow-lg">
    <h1 class="text-3xl font-semibold text-center text-gray-800 mb-6">Thông tin tài khoản của bạn</h1>
    <li class="hidden" value="{{$user->user_id}}"></li>
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
        <h3 class="text-2xl font-semibold text-gray-700 mb-4">🛒 Lịch sử mua hàng</h3>

        @if (empty($orders))
            <p class="text-gray-700 text-center">Bạn chưa có đơn hàng nào.</p>
        @else
            <table class="min-w-full table-auto border rounded-lg overflow-hidden">
                <thead>
                    <tr class="bg-green-500 text-white text-sm">
                        <th class="px-4 py-3 text-left">Mã đơn hàng</th>
                        <th class="px-4 py-3 text-left">Ngày mua</th>
                        <th class="px-4 py-3 text-left">Tổng tiền</th>
                        <th class="px-4 py-3 text-left">Trạng thái</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($orders as $order)
                        <tr class="hover:bg-gray-100 transition">
                            <td class="px-4 py-2 text-sm text-gray-800 font-medium">Đơn hàng: #{{ $order->id }}</td>
                            <td class="px-4 py-2 text-sm text-gray-700">{{ date('d/m/Y', strtotime($order->created_at)) }}</td>
                            <td class="px-4 py-2 text-sm text-gray-700">{{ number_format($order->total_price, 0, ',', '.') }} VNĐ</td>
                            <td class="px-4 py-2 text-sm font-medium">
                                @php
                                    $statusLabels = [
                                        'pending' => '⏳ Chờ xử lý',
                                        'processing' => '🔄 Đang xử lý',
                                        'paid' => '💰 Đã thanh toán',
                                        'shipped' => '📦 Đang giao',
                                        'delivered' => '✅ Đã giao',
                                        'cancelled' => '❌ Đã hủy',
                                    ];
                                @endphp
                                <span class="inline-block bg-gray-100 text-gray-800 rounded-full px-3 py-1 text-xs font-semibold">
                                    {{ $statusLabels[$order->status] ?? ucfirst($order->status) }}
                                </span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>
@endsection
