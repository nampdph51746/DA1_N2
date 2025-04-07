@extends('Client.layout')

@section('content')
<div class="container max-w-screen-md mx-auto my-12 p-6 bg-white rounded-2xl shadow-lg">
    <div class="text-center mb-8">
        <h2 class="text-3xl font-bold text-green-600 mb-2">🎉 Đặt hàng thành công!</h2>
        <p class="text-gray-700">Cảm ơn bạn đã mua sắm tại cửa hàng của chúng tôi.</p>
    </div>

    <div class="border-t border-b py-4 mb-6">
        <div class="flex justify-between text-lg font-medium text-gray-800 mb-2">
            <span>Mã đơn hàng:</span>
            <span class="text-blue-600 font-semibold">#{{ $order->id }}</span>
        </div>
        <div class="flex justify-between text-lg font-medium text-gray-800">
            <span>Tổng tiền:</span>
            <span class="text-red-600 font-semibold">{{ number_format($order->total_price, 0, ',', '.') }} đ</span>
        </div>
    </div>

    <h3 class="text-xl font-semibold text-gray-800 mb-4">🧾 Chi tiết đơn hàng</h3>
    @forelse($orderItems as $item)
    <div class="flex justify-between items-center border-b py-2">
        <div class="text-gray-700">
            <span class="font-medium">{{ $item->name }}</span>
            <span class="text-sm text-gray-500"> x {{ $item->quantity }}</span>
        </div>
        <div class="text-gray-800 font-semibold">
            {{ number_format($item->price * $item->quantity, 0, ',', '.') }} đ
        </div>
    </div>
    @empty
    <p class="text-gray-500 italic">Không có sản phẩm trong đơn hàng.</p>
    @endforelse

    <div class="mt-8 text-center">
        <a href="http://localhost/DA1_N2-main/" class="inline-block px-6 py-3 bg-blue-600 text-white rounded-xl hover:bg-blue-700 transition">Tiếp tục mua sắm</a>
    </div>
</div>
@endsection
