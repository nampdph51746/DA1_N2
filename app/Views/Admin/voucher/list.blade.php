@extends('Admin.layoutadmin')
@section('content')
<main class="flex-1 p-6 bg-white shadow-lg rounded-lg mx-auto">
    <!-- Nội dung  -->
      
    <h1 class="text-3xl font-bold text-gray-800 mb-4">📦 Danh sách Voucher
        <form action="{{APP_URL . 'admin/vouchers/search'}}" method="GET" class="space-y-2 my-4">
            <div class="flex flex-wrap gap-2">
                <!-- Tìm theo ID -->
                <input type="number" name="id" placeholder="ID sản phẩm" class="w-full md:w-1/6 border border-gray-300 rounded px-3 py-2 text-sm" />

                <select name="type" class="w-full md:w-1/4 border border-gray-300 rounded px-3 py-2 text-sm">
                    <option value="">Tất cả loại</option>
                    <option value="fixed">Cố định</option>
                    <option value="percent">Phần trăm</option>
                </select>

                <select name="status" class="w-full md:w-1/4 border border-gray-300 rounded px-3 py-2 text-sm">
                    <option value="">Tất cả trạng thái</option>
                    <option value="active">Khả dụng</option>
                    <option value="expired">Hết hạn</option>
                </select>
            </div>

            <div class="flex flex-wrap gap-2">
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
                    <th class="border border-gray-300 px-4 py-2">ID</th>
                    <th class="border border-gray-300 px-4 py-2">Code</th>
                    <th class="border border-gray-300 px-4 py-2">Loại Voucher</th>
                    <th class="border border-gray-300 px-4 py-2">Giá trị</th>
                    <th class="border border-gray-300 px-4 py-2">Trạng thái</th>
                    <th class="border border-gray-300 px-4 py-2">Ngày bắt đầu</th>
                    <th class="border border-gray-300 px-4 py-2">Ngày kết thúc</th>
                    <th class="border border-gray-300 px-4 py-2">Hành động</th>
                </tr>
            </thead>
            <tbody class="bg-white">
                @foreach ($vouchers as $v )
                
                <tr class="hover:bg-gray-100">
                    <td class="border border-gray-300 px-4 py-2 text-center">{{$v->id}}</td>    
                    <td class="border border-gray-300 px-4 py-2 text-center">{{$v->code}}</td>
                    <td class="border border-gray-300 px-4 py-2 text-center">{{$v->discount_type}}</td>
                    <td class="border border-gray-300 px-4 py-2 text-center">{{$v->discount_value}}</td>
                    <td class="border border-gray-300 px-4 py-2 text-center">{{$v->status}}</td>
                    <td class="border border-gray-300 px-4 py-2 text-center">{{$v->start_date}}</td>
                    <td class="border border-gray-300 px-4 py-2 text-center">{{$v->end_date}}</td>
                    <td class="border border-gray-300 px-10 py-2 text-center">
                        <div class="flex justify-center items-center gap-1">
                            <a href="{{APP_URL. 'admin/vouchers/edit/'.$v->id}}" 
                            class="bg-blue-500 text-white px-3 py-1 rounded-md hover:bg-blue-700 transition text-sm inline-flex items-center gap-1 h-8">
                                <span class="text-base leading-none">✏️</span>
                                <span class="leading-none">Sửa</span>
                            </a>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

<!-- End Nội dung -->
</main>
@endsection