<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>
<body>
<main class="min-h-screen bg-gray-100 flex items-center justify-center">
  <div class="w-full max-w-6xl mx-auto bg-white shadow-lg rounded-xl overflow-hidden grid grid-cols-1 md:grid-cols-2">
    
    <!-- Cột trái: Ảnh minh họa -->
    <div class="hidden md:flex items-center justify-center bg-blue-100">
      <img src="{{ APP_URL }}/images/banner_1.jpg" alt="Login Image" class="w-full h-full object-cover">
    </div>

    <!-- Cột phải: Form đăng nhập -->
    <div class="p-10">
      <h2 class="text-3xl font-bold text-gray-800 text-center mb-6">Chào mừng trở lại 👋</h2>
      <p class="text-gray-500 text-center mb-8">Vui lòng đăng nhập để tiếp tục</p>

      <form action="" method="POST" class="space-y-6">
        @isset($errors)
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
          {{ $errors['message'] }}
        </div>
        @endisset

        <div>
          <label for="username" class="block text-sm font-medium text-gray-700 mb-1">Tên đăng nhập</label>
          <input type="text" id="username" name="username"
                 class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                 value="{{ $data['username'] ?? '' }}" placeholder="Nhập tên đăng nhập">
        </div>

        <div>
          <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Mật khẩu</label>
          <input type="password" id="password" name="password"
                 class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                 placeholder="Nhập mật khẩu">
        </div>

        <button type="submit"
                class="w-full bg-purple-600 text-white font-semibold py-2 rounded-lg hover:bg-purple-700 transition duration-200">
          Đăng nhập
        </button>
      </form>

      <div class="text-center mt-8 space-y-3">
        <a href="{{ APP_URL . 'register' }}"
           class="block text-purple-600 font-medium hover:underline">Bạn chưa có tài khoản? Đăng ký ngay</a>
        <a href="{{ APP_URL . 'forgot-password' }}"
           class="block text-purple-600 font-medium hover:underline">Quên mật khẩu?</a>
        <a href="{{ APP_URL }}"
           class="block text-gray-600 font-medium hover:underline">← Quay lại trang chủ</a>
      </div>
    </div>
  </div>
</main>
</body>


