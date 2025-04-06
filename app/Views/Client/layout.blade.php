<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <section class="container max-w-screen-xl m-auto flex items-center justify-between py-4">
        <img loading="lazy" src="{{APP_URL }}/images/logo.jpg" class="w-24 h-24">
        <ul class="flex gap-8 font-medium text-xl">
            <li class="hover:text-amber-500"><a href="{{APP_URL .''}}">Trang chủ</a></li>
            <li class="hover:text-amber-500"><a href="{{APP_URL .'sanpham'}}">Sản phẩm</a></li>
            <li class="hover:text-amber-500"><a href="">Thông tin</a></li>
            <li class="hover:text-amber-500"><a href="">Liên hệ</a></li>
        </ul>
        <div class="flex items-center gap-4">
            <span class="material-symbols-outlined">search</span>
            <span class="material-symbols-outlined">favorite</span>
            <span class="material-symbols-outlined">shopping_cart</span>
            @if(isset($_SESSION['user']))
    <div x-data="{ open: false }" class="relative flex items-center gap-4">
        <strong class="text-gray-700">Xin chào {{ $_SESSION['user']->username }}</strong>

        <!-- Nút mở menu -->
        <button @click="open = !open" class="text-2xl text-gray-600 focus:outline-none">
            <span class="material-symbols-outlined">account_circle</span>
        </button>

        <!-- Dropdown menu -->
        <div 
        x-show="open"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 transform scale-95"
        x-transition:enter-end="opacity-100 transform scale-100"
        x-transition:leave="transition ease-in duration-75"
        x-transition:leave-start="opacity-100 transform scale-100"
        x-transition:leave-end="opacity-0 transform scale-95"
            @click.away="open = false"
            class="absolute right-0 mt-8 w-48 bg-white border border-gray-200 rounded-md shadow-lg z-50"
        >
            <a href="{{ APP_URL .'profile' }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                Quản lý tài khoản
            </a>
            <a href="{{ APP_URL . 'logout' }}" class="block px-4 py-2 text-sm text-red-500 hover:bg-red-100">
                Đăng xuất
            </a>

        </div>
    </div>
@else
    <a href="{{ APP_URL . 'login' }}" class="text-blue-600 font-medium hover:underline">Đăng nhập</a>
@endif

            
        </div>
    </section>
    <!--End Header-->
    <section class="relative w-full max-w-screen-xl mx-auto overflow-hidden">
        <!-- Slideshow Container -->
        <div class="relative h-[400px]">
            <img loading="lazy" src="{{APP_URL }}/images/bn4.jpg" class="absolute top-0 left-0 w-full h-full object-cover transition-opacity duration-100 opacity-100 slide active">
            <img loading="lazy" src="{{APP_URL }}/images/bn2.jpg" class="absolute top-0 left-0 w-full h-full object-cover transition-opacity duration-0 opacity-0 slide">
            <img loading="lazy" src="{{APP_URL }}/images/bn3.jpg" class="absolute top-0 left-0 w-full h-full object-cover transition-opacity duration-0 opacity-0 slide">
        </div>

        <!-- Previous Button -->
        <button 
            class="absolute top-1/2 left-2 transform -translate-y-1/2 text-white bg-gray-800 hover:bg-gray-900 p-2 rounded-full z-10" 
            onclick="changeSlide(-1)">
            &#10094;
        </button>

        <!-- Next Button -->
        <button 
            class="absolute top-1/2 right-2 transform -translate-y-1/2 text-white bg-gray-800 hover:bg-gray-900 p-2 rounded-full z-10" 
            onclick="changeSlide(1)">
            &#10095;
        </button>
    </section>
    <!--End Banner-->
    <main>
        @yield('content')
    </main>
    <section class="bg-[#FFF7ED] py-16 mt-16">
        <div class="container max-w-screen-xl m-auto grid grid-cols-4">
            <div class="flex gap-5 items-center">
                <img loading="lazy" src="{{APP_URL }}/images/anhgia.jpg" style="height: 55px; width: 55px;">
                <div>
                    <h3 class="font-semibold text-xl mb-1">Giá cả phải chăng</h3>
                    <p class="text-[#898989]">Dễ dàng tiếp cận các laptop thế hệ mới giá tốt.</p>
                </div>
            </div>
            <div class="flex gap-5 items-center">
                <img loading="lazy" src="{{APP_URL }}/images/anhluachon.jpg" style="height: 55px; width: 55px;">
                <div>
                    <h3 class="font-semibold text-xl mb-1">Lựa chọn đa dạng</h3>
                    <p class="text-[#898989]">Vô vàn lựa chọn phù hợp với sở thích của bạn.</p>
                </div>
            </div>
            <div class="flex gap-5 items-center">
                <img loading="lazy" src="{{APP_URL }}/images/anh247.jpg" style="height: 55px; width: 55px;">
                <div>
                    <h3 class="font-semibold text-xl mb-1"> 
                    Dịch vụ 24/7</h3>
                    <p class="text-[#898989]">Đội ngũ nhân viên chuyên nghiệp và thân thiện.</p>
                </div>
            </div>
            <div class="flex gap-5 items-center">
                <img loading="lazy" src="{{APP_URL }}/images/anhcauhinh.jpg" style="height: 55px; width: 55px;">
                <div>
                    <h3 class="font-semibold text-xl mb-1">Cấu hình cao cấp</h3>
                    <p class="text-[#898989]">Trải nghiệm nhưng cấu hình tuyệt vời.</p>
                </div>
            </div>
        </div>
    </section>
    <!--End Hightlight-->
    <footer class="bg-[#262626] text-white pt-16 pb-2">
        <div class="container max-w-screen-xl m-auto grid grid-cols-4 gap-8 mb-16">
            <div>
                <img loading="lazy" class="mb-4" src="{{APP_URL }}/images/logo.jpg" style="width: 100px; height: 100px;">
                <p>LAPTOP68 – Nâng tầm trải nghiệm công nghệ với những chiếc laptop mạnh mẽ, hiện đại và tối ưu nhất.</p>
            </div>
            <div>
                <h3 class="font-semibold text-xl mb-4">Sơ đồ trang web</h3>
                <ul>
                    <li class="mb-4"><a href=""></a>Trang chủ</li>
                    <li class="mb-4"><a href=""></a>Sản phẩm</li>
                    <li class="mb-4"><a href=""></a>Thông Tin</li>
                    <li><a href=""></a>Liên Hệ</li>
                </ul>
            </div>
            <div>
                <h3 class="font-semibold text-xl mb-4">Hỗ trợ</h3>
                <ul>
                    <li class="mb-4"><a href=""></a>Các phương thức thanh toán</li>
                    <li class="mb-4"><a href=""></a>Chính sách hoàn trả</li>
                    <li><a href=""></a>Chính sách bảo mật</li>
                </ul>
            </div>
            <div>
                <h3 class="font-semibold text-xl mb-4">Location</h3>
                <ul>
                    <li class="mb-4"><a href=""></a>nampd@gmail.com</li>
                    <li class="mb-4"><a href=""></a>60/850 Đường Láng, Láng Thượng</li>
                    <li><a href=""></a>Đống Đa, Hà Nội - 10000</li>
                </ul>
            </div>
        </div>
        <hr/>
        <p class="text-center my-8">Copyright @2025 by N2</p>
    </footer>
</body>
</html>
