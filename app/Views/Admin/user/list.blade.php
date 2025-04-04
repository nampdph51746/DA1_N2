@extends('Admin.layoutadmin')
@section('title','User')
@section('content')
<main class="flex-1 p-6 bg-white shadow-lg rounded-lg mx-auto">
    <!-- Nội dung  -->
      
    <h1 class="text-3xl font-bold text-gray-800 mb-4">📦 Danh sách người dùng
        <form action="{{APP_URL .'admin/users/search'}}" method="GET" class=" justify-center my-2">
            <div class="flex items-center bg-white shadow-sm rounded-full max-w-xs px-3 py-1 border border-gray-300">
                <input type="text" name="query" class="w-full bg-transparent focus:outline-none text-sm px-2" placeholder="Nhập từ khóa...">
                <button type="submit" class="bg-blue-500 text-white px-4 py-1 rounded-full text-sm hover:bg-blue-600 transition">
                    Tìm
                </button>
            </div>
        </form>
    </h1>


        <table class="w-full border-collapse border border-gray-300 shadow-sm">
            <thead class="bg-blue-600 text-white">
                <tr>
                    <th class="border border-gray-300 px-4 py-2">ID</th>
                    <th class="border border-gray-300 px-4 py-2">User name</th>
                    <th class="border border-gray-300 px-4 py-2">Full name</th>
                    <th class="border border-gray-300 px-4 py-2">Email</th>
                    <th class="border border-gray-300 px-4 py-2">Phone</th>
                    <th class="border border-gray-300 px-4 py-2">Adress</th>
                    <th class="border border-gray-300 px-4 py-2">Role</th>
                    <th class="border border-gray-300 px-4 py-2">Hành động</th>
                </tr>
            </thead>
            <tbody class="bg-white">
                @foreach ($users as $user)
                <tr class="hover:bg-gray-100">
                    <td class="border border-gray-300 px-4 py-2 text-center">{{$user->id}}</td>
                    <td class="border border-gray-300 px-4 py-2">{{$user->username}}</td>
                    <td class="border border-gray-300 px-4 py-2 text-right">{{$user->full_name}}</td>
                    <td class="border border-gray-300 px-4 py-2">{{$user->email}}</td>
                    <td class="border border-gray-300 px-4 py-2">{{$user->phone}}</td>
                    <td class="border border-gray-300 px-4 py-2">{{$user->address}}</td>
                    <td class="border border-gray-300 px-4 py-2">{{$user->role}}</td>
                    <td class="border border-gray-300 px-10 py-2 text-center">
                        <div class="flex justify-center items-center gap-1">
                            <a href="" 
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