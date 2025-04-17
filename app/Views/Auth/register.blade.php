<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Đăng ký</title>
  <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>
<body>
  <main class="min-h-screen bg-gray-100 flex items-center justify-center">
    <div class="w-full max-w-6xl mx-auto bg-white shadow-lg rounded-xl overflow-hidden grid grid-cols-1 md:grid-cols-2">
      
      <!-- Bên trái: Hình ảnh -->
      <div class="hidden md:flex items-center justify-center bg-blue-100">
        <img src="{{ APP_URL }}/images/register.jpg" alt="Login Image" class="w-full h-full object-cover">
      </div>

      <!-- Bên phải: Form đăng ký -->
      <div class="p-10">
        <div class="text-center mb-6">
          <img src="https://cdn-icons-png.flaticon.com/512/295/295128.png" alt="Logo" class="mx-auto w-16 h-16">
          <h3 class="mt-3 text-2xl font-bold text-gray-800">Tạo tài khoản</h3>
          <p class="text-gray-500">Nhanh chóng và dễ dàng</p>
        </div>

        <form action="" method="POST" class="space-y-4">
          <div>
            <label for="username" class="block mb-1 font-medium text-gray-700">Tên đăng nhập</label>
            <input type="text" id="username" name="username" placeholder="Nhập tên đăng nhập"
              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" required>
          </div>

          <div>
            <label for="password" class="block mb-1 font-medium text-gray-700">Mật khẩu</label>
            <input type="password" id="password" name="password" placeholder="Nhập mật khẩu"
              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" required>
          </div>

          <div>
            <label for="full_name" class="block mb-1 font-medium text-gray-700">Họ và tên</label>
            <input type="text" id="full_name" name="full_name" placeholder="Nhập họ và tên"
              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" required>
          </div>

          <div>
            <label for="email" class="block mb-1 font-medium text-gray-700">Email</label>
            <input type="email" id="email" name="email" placeholder="Nhập email"
              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" required>
          </div>

          <div>
            <label for="phone" class="block mb-1 font-medium text-gray-700">Số điện thoại</label>
            <input type="tel" id="phone" name="phone" placeholder="Nhập số điện thoại"
              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" required>
          </div>

          <div>
            <label for="address" class="block mb-1 font-medium text-gray-700">Địa chỉ</label>
            <input type="text" id="address" name="address" placeholder="Nhập địa chỉ"
              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" required>
          </div>

          <button type="submit"
            class="w-full bg-purple-600 text-white py-2 rounded-lg font-semibold hover:bg-purple-700 transition duration-200">
            Đăng ký
          </button>
        </form>

        <div class="text-center mt-4">
          <span class="text-gray-600">Đã có tài khoản?</span>
          <a href="{{ APP_URL . 'login' }}"
            class="inline-block mt-2 w-full py-2 border border-purple-600 text-white-600 rounded-lg hover:bg-blue-50 transition duration-200">
            Đăng nhập
          </a>
        </div>
      </div>
    </div>
  </main>
</body>
</html>
