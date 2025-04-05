@extends('Admin.layoutadmin')
@section('content')
<main class="flex-1 p-6 bg-white shadow-lg rounded-lg mx-auto">
    <!-- Nội dung  -->
    <h1 class="text-3xl font-bold text-gray-800 mb-4">📦 Danh sách đơn hàng
        <form action="{{APP_URL . 'admin/orders/search'}}" method="GET" class=" space-y-2 my-4">
            <div class="flex flex-wrap gap-2">
                <!-- Tìm theo tên -->
                <input type="text" name="name" placeholder="Tên người đặt" class="w-full md:w-1/3 border border-gray-300 rounded px-3 py-2 text-sm" />

                <!-- Tìm theo ID -->
                <input type="number" name="id" placeholder="ID đơn hàng" class="w-full md:w-1/6 border border-gray-300 rounded px-3 py-2 text-sm" />

                <select name="status" class="w-full md:w-1/4 border border-gray-300 rounded px-3 py-2 text-sm">
                    <option value="">Tất cả trạng thái</option>
                    <option value="pending">⏳ Chờ xử lý</option>
                    <option value="processing">🔄 Đang xử lý</option>
                    <option value="paid">💰 Đã thanh toán</option>
                    <option value="shipped">📦 Đang giao</option>
                    <option value="delivered">✅ Đã giao</option>
                    <option value="cancelled">❌ Đã hủy</option>
                </select>
            </div>

            <div class="flex flex-wrap gap-2">
                <!-- Ngày tạo từ -->
                <input type="date" name="created_at" class="w-full md:w-1/4 border border-gray-300 rounded px-3 py-2 text-sm" />

                <!-- Ngày tạo đến -->
                <input type="date" name="updated_at" class="w-full md:w-1/4 border border-gray-300 rounded px-3 py-2 text-sm" />
                <div class="flex justify-end">
                    <button type="submit" class="bg-blue-500 text-white px-5 py-2 rounded-full text-sm hover:bg-blue-600 transition">
                        Tìm kiếm
                    </button>
                    <button type="submit" class="bg-gray-500 text-white px-5 py-2 rounded-full text-sm hover:bg-gray-600 transition">
                        Reset
                    </button>
                </div>
            </div>
        </form>
    </h1>

        <table class="w-full border-collapse border border-gray-300 shadow-sm">
            <thead class="bg-blue-600 text-white">
                <tr>
                    <th class="border border-gray-300 px-4 py-2">Đơn ID</th>
                    <th class="border border-gray-300 px-4 py-2">Người mua</th>
                    <th class="border border-gray-300 px-4 py-2">Trạng thái</th>
                    <th class="border border-gray-300 px-4 py-2">Ngày Đặt</th>
                    <th class="border border-gray-300 px-4 py-2">Ngày Cập Nhật</th>
                    <th class="border border-gray-300 px-4 py-2">Hành động</th>
                </tr>
            </thead>
            <tbody class="bg-white">
                @foreach ($orders as $order )
                
                <tr class="hover:bg-gray-100">
                    <td class="border border-gray-300 px-4 py-2 text-center">{{$order->id}}</td>
                    <td class="border border-gray-300 px-4 py-2 text-center">{{$order->full_name}}</td>
                    <td class="border border-gray-300 px-4 py-2 text-center">
                        <form action="orders/update-status" method="POST">
                            <input type="hidden" name="order_id" value="{{ $order->id }}">
                            
                            <div class="flex items-center justify-center gap-4">
                                <select name="status" class="form-select text-center w-40 py-1 rounded-md border border-gray-300">
                                    <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>⏳ Chờ xử lý</option>
                                    <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>🔄 Đang xử lý</option>
                                    <option value="paid" {{ $order->status == 'paid' ? 'selected' : '' }}>💰 Đã thanh toán</option>
                                    <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>📦 Đang giao</option>
                                    <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>✅ Đã giao</option>
                                    <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>❌ Đã hủy</option>
                                </select>
                                @if ($order->status !== 'delivered' && $order->status !== 'cancelled')
                                    <button type="submit" name="action" value="update"
                                        class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition text-sm w-full md:w-auto">
                                        <span class="text-base leading-none">🔄</span>
                                        <span class="leading-none">Cập nhật trạng thái</span>
                                    </button>
                                @endif
                            </div>
                        </form>
                    </td>
                    <td class="border border-gray-300 px-4 py-2 text-center">{{$order->created_at}}</td>
                    <td class="border border-gray-300 px-4 py-2 text-center">{{$order->updated_at}}</td>
                    <td class="border border-gray-300 px-10 py-2 text-center">
                            <a href="{{ APP_URL . 'admin/orders/detail/' . $order->id . '&full_name=' . urlencode($order->full_name) }}"
                                class="bg-green-500 text-white px-3 py-1 rounded-md hover:bg-green-700 transition text-sm inline-flex items-center gap-1 h-8">
                                <span class="text-base leading-none">🔍</span>
                                <span class="leading-none">Chi tiết</span>
                            </a>
                            @if ($order->status !== 'delivered' && $order->status !== 'cancelled')
                                <!-- <form action="orders/update-status" method="POST">
                                    <input type="hidden" name="order_id" value="{{$order->id}}">

                                    @if ($order->status !== 'paid' && $order->status !== 'shipped')
                                        <button type="submit" name="action" value="cancel"
                                            class="bg-red-500 text-white px-3 py-1 rounded-md hover:bg-red-700 transition text-sm inline-flex items-center gap-1 h-8">
                                            <span class="text-base leading-none">❌</span>
                                            <span class="leading-none">Hủy đơn</span>
                                        </button>
                                    @endif
                                </form> -->
                            @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

<!-- End Nội dung -->
</main>
@endsection