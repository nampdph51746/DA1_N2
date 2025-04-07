@extends('Admin.layoutadmin')

@section('content')
<main class="p-6 bg-white shadow-lg rounded-lg mx-auto">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">📦 Chi tiết đơn hàng</h1>

    <div class="grid grid-cols-2 gap-6">
        <!-- Thông tin chính -->
        <div>
            <img src="{{ APP_URL . 'images/Order.png' }}"
                 class="w-full max-w-xs h-auto object-cover rounded-lg shadow-md">
        </div>

        <div>
            <h2 class="text-2xl font-semibold text-gray-900">ID Đơn Hàng: {{ $order->id }}</h2>
            <p class="text-gray-600 mt-2">Người mua: {{ $order->fullname }}</p>
            <p class="text-gray-600 mt-2">
                Trạng thái: 
                <span class="
                    {{ $order->status === 'pending' ? 'text-yellow-500 font-bold' : '' }}
                    {{ $order->status === 'processing' ? 'text-blue-500 font-bold' : '' }}
                    {{ $order->status === 'paid' ? 'text-green-500 font-bold' : '' }}
                    {{ $order->status === 'shipped' ? 'text-indigo-500 font-bold' : '' }}
                    {{ $order->status === 'delivered' ? 'text-green-700 font-bold' : '' }}
                    {{ $order->status === 'cancelled' ? 'text-red-500 font-bold' : '' }}">
                    @if($order->status === 'pending')
                        ⏳ Chờ xử lý
                    @elseif($order->status === 'processing')
                        🔄 Đang xử lý
                    @elseif($order->status === 'paid')
                        💰 Đã thanh toán
                    @elseif($order->status === 'shipped')
                        📦 Đang giao
                    @elseif($order->status === 'delivered')
                        ✅ Đã giao
                    @elseif($order->status === 'cancelled')
                        ❌ Đã huỷ
                    @endif
                </span>
            </p>
            <p class="text-gray-600 mt-2">Số lượng sản phẩm: {{ $totalQuantity }}</p>
            <p class="mt-4 text-lg font-bold text-red-600">Tổng giá trị: {{ number_format($order->total_price, 0, ',', '.') }} VNĐ</p>
            <p class="text-gray-500 text-sm mt-2">Ngày tạo: {{ $order->created_at }}</p>
            <p class="text-gray-500 text-sm">Cập nhật gần nhất: {{ $order->updated_at }}</p>
        </div>
    </div>

    <!-- Danh sách sản phẩm trong đơn hàng -->
    <div class="mt-8">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4">🎨 Thông tin đơn hàng</h2>
        
        <table class="w-full border-collapse border border-gray-300 shadow-sm">
            <thead class="bg-gray-200">
                <tr>
                    <th class="border border-gray-300 px-4 py-2">Tên sản phẩm</th>
                    <th class="border border-gray 🙂-300 px-4 py-2">Màu sắc</th>
                    <th class="border border-gray-300 px-4 py-2">Hình ảnh</th>
                    <th class="border border-gray-300 px-4 py-2">Giá</th>
                    <th class="border border-gray-300 px-4 py-2">Số lượng</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($items as $item)
                <tr class="hover:bg-gray-100">
                    <td class="border border-gray-300 px-4 py-2 text-center">({{ $item['variant_name'] }})</td>
                    <td class="border border-gray-300 px-4 py-2 text-center">{{ $item['color'] }}</td>
                    <td class="border border-gray-300 px-4 py-2 text-center">
                        <img src="{{ $item['image_url'] }}" class="w-22 h-20 object-cover rounded-lg shadow-md">
                    </td>
                    <td class="border border-gray-300 px-4 py-2 text-center">{{ number_format($item['price'], 0, ',', '.') }} VNĐ</td>
                    <td class="border border-gray-300 px-4 py-2 text-center">{{ $item['quantity'] }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="border border-gray-300 px-4 py-2 text-center">Không có sản phẩm trong đơn hàng.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</main>
@endsection