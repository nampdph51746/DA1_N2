@extends('Admin.layoutadmin')
@section('content')
<main class="flex-1 p-6 bg-white shadow-lg rounded-lg mx-auto">
    <!-- Nội dung  -->
      
    <h1 class="text-3xl font-bold text-gray-800 mb-4">📦 Danh sách bình luận
        <form action="{{APP_URL . 'admin/reviews/search'}}" method="GET" class="space-y-2 my-4">
            <div class="flex flex-wrap gap-2">
                <!-- Tìm theo tên -->
                <input type="text" name="name" placeholder="Tên người bình luận" class="w-full md:w-1/3 border border-gray-300 rounded px-3 py-2 text-sm" />

                <!-- Tìm theo ID -->
                <input type="number" name="id" placeholder="ID bình luận" class="w-full md:w-1/6 border border-gray-300 rounded px-3 py-2 text-sm" />

                <!-- Giá từ -->
                <input type="number" name="rating" step="1000" placeholder="Đánh giá" class="w-full md:w-1/6 border border-gray-300 rounded px-3 py-2 text-sm" />

                <!-- Giá đến -->
                <input type="text" name="product" step="1000" placeholder="Sản phẩm được đánh giá" class="w-full md:w-1/6 border border-gray-300 rounded px-3 py-2 text-sm" />
            </div>

            <div class="flex flex-wrap gap-2">
                <select name="status" class="w-full md:w-1/4 border border-gray-300 rounded px-3 py-2 text-sm">
                    <option value="">Tất cả trạng thái</option>
                    <option value="Ẩn">Ẩn</option>
                    <option value="Hiện">Hiện</option>
                </select>
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
                    <th class="border border-gray-300 px-4 py-2">Sản phẩm bình luận</th>
                    <th class="border border-gray-300 px-4 py-2">Người bình luận</th>
                    <th class="border border-gray-300 px-4 py-2">Đánh giá</th>
                    <th class="border border-gray-300 px-4 py-2">Trạng thái</th>
                    <th class="border border-gray-300 px-4 py-2">Ngày bình luận</th>
                    <th class="border border-gray-300 px-4 py-2">Ngày cập nhật</th>
                    <th class="border border-gray-300 px-4 py-2">Hành động</th>
                </tr>
            </thead>
            <tbody class="bg-white">
                @foreach ($reviews as $r )
                
                <tr class="hover:bg-gray-100">
                    <td class="border border-gray-300 px-4 py-2 text-center">{{$r->id}}</td>
                    <td class="border border-gray-300 px-4 py-2 text-center">{{$r->product_name}}</td>
                    <td class="border border-gray-300 px-4 py-2 text-center">{{$r->full_name}}</td>
                    <td class="border border-gray-300 px-4 py-2 text-center">{{$r->rating}}</td>
                    <td class="border border-gray-300 px-4 py-2 text-center {{ $r->review_status === 'Hiện' ? 'text-green-600 font-bold' : 'text-red-600 font-bold' }}"> 
                    {{$r->review_status}}</td>
                    <td class="border border-gray-300 px-4 py-2 text-center">{{$r->created_at}}</td>
                    <td class="border border-gray-300 px-4 py-2 text-center">{{$r->updated_at}}</td>
                    <td class="border border-gray-300 px-10 py-2 text-center">
                        <div class="flex justify-center items-center gap-1">
                            <a href="{{APP_URL. 'admin/reviews/detail/'.$r->id}}" 
                            class="bg-green-500 text-white px-3 py-1 rounded-md hover:bg-green-700 transition text-sm inline-flex items-center gap-1 h-8">
                                <span class="text-base leading-none">🔍</span>
                                <span class="leading-none">Chi tiết</span>
                            </a>
                            <a href="{{APP_URL. 'admin/reviews/edit/'.$r->id}}" 
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