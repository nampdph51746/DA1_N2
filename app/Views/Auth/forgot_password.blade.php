@extends('Client.layout')

@section('content')
<div class="container mx-auto py-8">
    <h2 class="text-2xl font-bold text-center mb-8 text-gray-800">Quên mật khẩu</h2>
    <form action="{{APP_URL . 'forgot-password'}}" method="POST" class="max-w-md mx-auto bg-white p-6 rounded shadow">
        <div class="mb-4">
            <label for="email" class="block text-gray-700 font-medium mb-2">Email</label>
            <input type="email" name="email" id="email" required
                class="w-full border border-gray-300 p-2 rounded focus:ring-2 focus:ring-blue-500">
        </div>
        <div class="mb-4">
            <label for="phone" class="block text-gray-700 font-medium mb-2">Số điện thoại</label>
            <input type="text" name="phone" id="phone" required
                class="w-full border border-gray-300 p-2 rounded focus:ring-2 focus:ring-blue-500">
        </div>
        <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 transition">
            Xác nhận
        </button>
    </form>
</div>
@endsection