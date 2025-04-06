@extends('Admin.layoutadmin')
@section('title','Danh sách danh mục')

@section('content')
<main class="flex-1 p-6 bg-white shadow-lg rounded-lg mx-auto">
  <!-- Nội dung  -->
  <h1 class="text-3xl font-bold text-gray-800 mb-4">📦 Danh sách danh mục
    <form action="{{APP_URL . 'admin/categories/search'}}" method="GET" class=" space-y-2 my-4">
        <div class="flex flex-wrap gap-2">
            <!-- Tìm theo tên -->
            <input type="text" name="name" placeholder="Tên danh mục" class="w-full md:w-1/3 border border-gray-300 rounded px-3 py-2 text-sm" />

            <select name="status" class="w-full md:w-1/4 border border-gray-300 rounded px-3 py-2 text-sm">
                <option value="">Tất cả trạng thái</option>
                <option value="Đang kinh doanh">Đang kinh doanh</option>
                <option value="Ngừng kinh doanh">Ngừng kinh doanh</option>
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
      <div class="mt-4 text-left text-xl">
          <a href="{{APP_URL . 'admin/categories/create' }}" class="bg-green-500 text-white px-3 py-1 rounded-md hover:bg-green-700 transition">
              ➕ Thêm danh mục
          </a>
      </div>
  </h1>

      <table class="w-full border-collapse border border-gray-300 shadow-sm">
          <thead class="bg-blue-600 text-white">
              <tr>
                  <th class="border border-gray-300 px-4 py-2">ID</th>
                  <th class="border border-gray-300 px-4 py-2">Tên sản phẩm</th>
                  <th class="border border-gray-300 px-4 py-2">Trạng thái</th>
                  <th class="border border-gray-300 px-4 py-2">Hành động</th>
              </tr>
          </thead>
          <tbody class="bg-white">
            @foreach ( $categories as $cate )
              <tr class="hover:bg-gray-100">
                  <td class="border border-gray-300 px-4 py-2 text-center">{{$cate->id}}</td>
                  <td class="border border-gray-300 px-4 py-2 text-center"> {{$cate->category_name}}</td>
                  <td class="border border-gray-300 px-4 py-2">
                        <span class="font-semibold px-2 py-1 rounded 
                            {{ $cate->category_status == 'Đang kinh doanh' ? 'text-green-600 font-bold text-center' : 'text-red-600 font-bold text-center' }}">
                            {{ $cate->category_status }}
                        </span>
                    </td>
                  <!-- <td class="border border-gray-300 px-4 py-2 text-center
                  {{ $cate->category_status === 'Đang kinh doanh' ? 'text-green-600 font-bold' : 'text-red-600 font-bold' }}"> 
                  {{$cate->category_status}}</td> -->
                  <td class="border border-gray-300 px-4 py-2 text-center">
                      <a href="{{APP_URL . 'admin/categories/edit/'.$cate->id }}" 
                          class="bg-blue-500 text-white px-3 py-1 rounded-md hover:bg-blue-700 transition">
                              ✏️ Sửa
                      </a>
                      <!-- <a href="{{APP_URL . 'admin/categories/delete/'.$cate->id }}" 
                          onclick="return confirmDelete(event)"
                          class="bg-red-500 text-white px-3 py-1 rounded-md hover:bg-red-700 transition ml-2">
                              ❌ Xóa
                      </a> -->
                  </td>
              </tr>
              @endforeach
          </tbody>
      </table>

<script>
  function confirmDelete(event, productId) {
      let confirmAction = confirm("❗ Bạn có chắc chắn muốn xóa sản phẩm này không?");
      if (!confirmAction) {
          event.preventDefault(); 
      }
  }
</script>
<!-- End Nội dung -->
</main>
@endsection