@extends('Admin.layoutadmin')
@section('title','danh muc san pham')

@section('content')
<main class="flex-1 p-6 bg-white shadow-lg rounded-lg mx-auto">
  <!-- Nội dung  -->
  <h1 class="text-3xl font-bold text-gray-800 mb-4">📦 Danh sách danh mục
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
                  <td class="border border-gray-300 px-4 py-2"> {{$cate->category_name}}</td>
                  <td class="border border-gray-300 px-4 py-2"> {{$cate->category_status}}</td>
                  <td class="border border-gray-300 px-4 py-2 text-center">
                      <a href="{{APP_URL . 'admin/categories/edit/'.$cate->id }}" 
                          class="bg-blue-500 text-white px-3 py-1 rounded-md hover:bg-blue-700 transition">
                              ✏️ Sửa
                      </a>
                      <a href="{{APP_URL . 'admin/categories/delete/'.$cate->id }}" 
                          onclick="return confirmDelete(event)"
                          class="bg-red-500 text-white px-3 py-1 rounded-md hover:bg-red-700 transition ml-2">
                              ❌ Xóa
                      </a>
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