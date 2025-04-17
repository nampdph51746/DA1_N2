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
                <li><a href="{{APP_URL .'admin/users'}}" class="flex items-center p-2 hover:bg-blue-800 rounded"><span>👤</span> <span class="ml-3">Người dùng</span></a></li>
                <li><a href="{{APP_URL .'admin/orders'}}" class="flex items-center p-2 hover:bg-blue-800 rounded"><span>🛒</span> <span class="ml-3">Đơn hàng</span></a></li>
                <li><a href="{{APP_URL .'admin/reviews'}}" class="flex items-center p-2 hover:bg-blue-800 rounded"><span>💬</span> <span class="ml-3">Bình luận</span></a></li>
                <li><a href="{{APP_URL .'admin/vouchers'}}" class="flex items-center p-2 hover:bg-blue-800 rounded"><span>🏷️</span> <span class="ml-3">Voucher</span></a></li>
            </ul>
        </aside>

        <!-- Nội dung chính -->
        <main class="flex-1 p-6 bg-white shadow-lg rounded-lg mx-auto">
            @if(isset($_SESSION['user']) && ($_SESSION['user']->role == 'admin' || $_SESSION['user']->role == 'editor'))
                <div class="mb-6 p-6 bg-gradient-to-r from-green-100 to-green-50 border border-green-300 text-green-800 rounded-2xl shadow-md">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-xl font-semibold">👋 Xin chào, <span class="text-green-700">{{ $_SESSION['user']->username }}</span></h2>
                        <a href="{{ APP_URL . 'logout' }}"
                            @click="open = false"
                            class="inline-block px-4 py-2 bg-red-500 text-white text-sm font-medium rounded-lg hover:bg-red-600 transition duration-150 ease-in-out shadow">
                                🔓 Đăng xuất
                        </a>
                    </div>
                    <div class="flex items-center space-x-4">
                        <a href="{{ APP_URL }}"
                        class="inline-block px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition duration-150">
                            🏠 Quay về Trang chủ
                        </a>
                    </div>
                </div>
            @endif
            <!-- Nội dung  -->
            @yield('content')
            <!-- End Nội dung -->
        </main>
    </div>

</body>
</html>
