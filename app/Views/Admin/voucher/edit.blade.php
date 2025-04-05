@extends('Admin.layoutadmin')
@section('content')
<main class="flex-1 p-6 bg-white shadow-lg rounded-lg mx-auto">
    <!-- Nội dung  -->
    <h1 class="text-3xl font-bold text-blue-700 mb-6">➕ Cập nhật thông tin voucher</h1>

    <form action="{{APP_URL . 'admin/vouchers/update/' .$voucher->id}}" method="POST" class="bg-white p-6 rounded-lg shadow-md w-full max-w-lg" enctype="multipart/form-data">
        <input type="hidden" name="id" value="{{ $voucher->id }}">
        <div class="mb-4">
            <label for="code" class="block text-gray-700 font-semibold">Code:</label>
            <input type="text" id="code" name="code" value="{{$voucher->code}}"  
                   class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                   >
        </div>

        <div class="mb-4">
            <label for="discount_type" class="block text-gray-700 font-semibold">Loại voucher</label>
            
            <select name="discount_type" id="discount_type" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="percent" {{ $voucher->discount_type == 'percent' ? 'selected' : '' }}>percent</option>
                <option value="fixed" {{ $voucher->discount_type == 'fixed' ? 'selected' : '' }}>fixed</option>
            </select>
        </div>

        <div class="mb-4">
            <label for="discount_value" class="block text-gray-700 font-semibold">Giá trị voucher:</label>
            <input type="number" step="0.01" id="discount_value" name="discount_value" value="{{$voucher->discount_value}}"  
                   class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                   >
        </div>

        <div class="mb-4">
            <label for="start_date" class="block text-gray-700 font-semibold">Ngày bắt đầu:</label>
            <input type="date" id="start_date" name="start_date" 
                value="{{ date('Y-m-d', strtotime($voucher->start_date)) }}"  
                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div class="mb-4">
            <label for="end_date" class="block text-gray-700 font-semibold">Ngày kết thúc:</label>
            <input type="date" id="end_date" name="end_date" 
                value="{{ date('Y-m-d', strtotime($voucher->end_date)) }}"  
                   class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                   >
        </div>

        <div class="mb-4">
            <label for="status" class="block text-gray-700 font-semibold">Trạng thái</label>
            
            <select name="status" id="status" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="active" {{ $voucher->status == 'percent' ? 'selected' : '' }}>active</option>
                <option value="expired" {{ $voucher->status == 'expired' ? 'selected' : '' }}>expired</option>
            </select>
        </div>
    
        <button type="submit" 
                class="bg-blue-700 text-white px-6 py-2 rounded-md font-semibold hover:bg-blue-800 transition">
            💾 Sửa
        </button>
    </form>      
    <!-- End Nội dung -->
</main>
@endsection