<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"> --}}
    
</head>
<body class="bg-gray-100">

    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-blue-700 text-white p-5">
            <h1 class="text-2xl font-bold text-center">Base Admin</h1>
            <ul class="mt-6 space-y-3">
                <li><a href="/" class="flex items-center p-2 hover:bg-blue-800 rounded"><span>🏠</span> <span class="ml-3">Trang chủ</span></a></li>
                <li><a href="{{APP_URL . 'admin/products'}}" class="flex items-center p-2 hover:bg-blue-800 rounded"><span>📦</span> <span class="ml-3">Sản phẩm</span></a></li>
                <li><a href="{{APP_URL . 'admin/categories'}}" class="flex items-center p-2 hover:bg-blue-800 rounded"><span>📂</span> <span class="ml-3">Danh mục</span></a></li>
                <li><a href="" class="flex items-center p-2 hover:bg-blue-800 rounded"><span>📄</span> <span class="ml-3">Đơn hàng</span></a></li>
            </ul>
        </aside>

        <!-- Nội dung chính -->
        <main class="flex-1 p-6 bg-white shadow-lg rounded-lg mx-auto">
            <!-- Nội dung  -->
            @yield('content')
            <!-- End Nội dung -->
        </main>
    </div>

</body>
</html>
