@extends('Client.layout')
@section('content')
<div class="max-w-7xl mx-auto p-8 bg-white shadow-lg rounded-2xl border border-gray-200">
    <div class="flex justify-between items-center mb-4">
        <h2 class="font-semibold text-[40px] relative">
            Chi tiết sản phẩm
            <span class="block w-16 h-1 bg-purple-500 mt-2"></span>
        </h2>
    </div>
    <section>
            <div class="grid grid-cols-2 gap-8">
                <div class="grid grid-cols-6 gap-8">
                    <div class="col-span-5">
                        <img id="variant-image" src="<?php echo APP_URL . htmlspecialchars($product_variants[0]->image_url); ?>" alt="Ảnh sản phẩm" />
                    </div>
                </div>

                <div>
                    <p class="font-medium text-xl">Tên: {{ $product->product_name }}</p>
                    <p class="font-bold text-[40px] text-[#EF4444] my-2">Giá: {{ number_format($product->price, 0, ',', '.') }} VND</p>
                    <div class="flex items-center">
                        <div class="text-yellow-500 border-r border-solid border-neutral-300 pr-4 mr-4">
                            <span class="material-icons">star</span>
                            <span class="material-icons">star</span>
                            <span class="material-icons">star</span>
                            <span class="material-icons">star</span>
                            <span class="material-icons">star</span>
                        </div>
                        <span class="font-medium text-sm text-neutral-400">5 Customer Review</span>
                    </div>
                    <p class="my-4"><strong>Thương hiệu: </strong>{{ $category->category_name }}</p>
                    <p><strong>Biến thể: </strong></p>
                    <select name="color" id="color-select">
                        <?php if (!empty($product_variants)): ?>
                            <?php foreach ($product_variants as $variant): ?>
                                <option 
                                    value="<?php echo htmlspecialchars($variant->color); ?>" 
                                    data-stock="<?php echo htmlspecialchars($variant->stock); ?>"
                                    data-image="<?php echo APP_URL . htmlspecialchars($variant->image_url); ?>"
                                >
                                    <?php echo htmlspecialchars($variant->color); ?>
                                </option>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <option value="">Không có biến thể</option>
                        <?php endif; ?>
                    </select>

                    <p class="font-medium my-4"><strong>Số lượng tồn kho: </strong>
                        <span id="stock-display">
                            <?php echo !empty($product_variants) ? htmlspecialchars($product_variants[0]->stock) : '0'; ?>
                        </span>
                    </p>
                    <div>
                        <p><strong>Mô tả: </strong>{{ $product->description }}</p>
                    </div>
                    <div class="mt-4 mb-8 flex flex-col items-start">
                        <p><strong>Trạng thái:</strong> {{ $product->status }}</p>
                        <hr class="text-neutral-400 mt-8 mb-3">
                        <div class="*:text-neutral-400">
                            <p>Mã sản phẩm: {{ $product->id }}</p>
                            <p>Hãng: {{ $category->category_name }}</p>
                        </div>
                    </div>
                    <a href="#" class="bg-yellow-500 text-white px-8 py-3 rounded-lg text-lg font-semibold shadow-md hover:bg-yellow-600 transition mr-4">
                        Thêm vào giỏ hàng
                    </a> 
                    <a href="{{APP_URL .'sanpham'}}" class="bg-red-500 text-white px-8 py-3 rounded-lg text-lg font-semibold shadow-md hover:bg-red-600 transition">
                        Quay lại
                    </a>
            </div>
        </section>
    
        <section class="my-8">
            <!-- Danh sách đánh giá -->
            <div>
                <div class="*:font-semibold *:text-xl *:mr-16 border-b pb-4 mb-8">
                    <a href="" class="text-neutral-400">Reviews[5]</a>
                </div>
                <div class="*:font-semibold *:text-neutral-400 mb-4 mb-8">
                                
                </div>
            </div>
            <div id="review-list">
                <div class='review p-4 bg-white rounded-lg shadow-md mb-4'>
                    <div class='review-rating mb-2'>
                        <span class='text-yellow-500'></span>
                        </div>
                            <p class='review-text text-gray-700'></p>
                            <p class='review-user text-sm text-gray-500 mt-2'>Đánh giá bởi:</p>
                            <div class="mt-4 space-y-4">
                                <div class="p-4 border rounded-lg shadow-sm">
                                    <p class="text-gray-700"><strong>Admin:</strong> Laptop rất tốt, pin trâu, hiệu năng mạnh.</p>
                                    <p class="text-sm text-gray-500">★★★★★</p>
                                </div>
                                <div class="p-4 border rounded-lg shadow-sm">
                                    <p class="text-gray-700"><strong>Người dùng:</strong> Thiết kế đẹp, màn hình sắc nét.</p>
                                    <p class="text-sm text-gray-500">★★★★☆</p>
                                </div>
                                <div class="p-4 border rounded-lg shadow-sm">
                                    <p class="text-gray-700"><strong>Khách hàng:</strong> Giá hơi cao nhưng đáng tiền.</p>
                                    <p class="text-sm text-gray-500">★★★★☆</p>
                                </div>
                            </div>
                        </div>
                        <!-- Form Bình luận -->
                        <div class="review-form mt-8 p-6 bg-white rounded-lg shadow-md">
                            <h4 class="text-xl font-semibold text-gray-700 mb-4">Để lại Đánh giá của bạn</h4>
                                <!-- Người dùng đã đăng nhập -->
                                <form action="" method="POST" id="review-form" class="space-y-4">
                                    <div>
                                        <label for="rating" class="block text-gray-600">Đánh giá (Sao):</label>
                                        <select id="rating" name="rating" class="w-full mt-2 p-2 border border-gray-300 rounded-md">
                                            <option value="5">★★★★★</option>
                                            <option value="4">★★★★☆</option>
                                            <option value="3">★★★☆☆</option>
                                            <option value="2">★★☆☆☆</option>
                                            <option value="1">★☆☆☆☆</option>
                                        </select>
                                    </div>
                    
                                    <div>
                                        <label for="comment" class="block text-gray-600">Nhận xét:</label>
                                        <textarea id="comment" name="comment" rows="4" class="w-full mt-2 p-2 border border-gray-300 rounded-md" required></textarea>
                                    </div>
                                    <input type="hidden" name="" value="">
                                    <button type="submit" name="submit_review" class="w-full bg-purple-600 text-white p-3 rounded-md hover:bg-blue-700 transition-colors">Gửi Đánh giá</button>
                                </form>
                        </div>
                    </div>
                </div>
        <section class="my-16">
            <div class="mb-4">
                <h2 class="font-semibold text-[40px] text-center">Sản phẩm liên quan</h2>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach ($products as $product)
                    <div class="bg-white shadow-lg rounded-lg p-4 hover:shadow-xl transition flex flex-col min-h-[400px]">
                        <!-- Hình ảnh -->
                        <div class="w-full h-48 flex items-center justify-center overflow-hidden rounded-md">
                            <img src="{{ APP_URL . $product->image_url }}" alt="{{ $product->product_name }}" 
                                class="w-full h-full object-contain">
                        </div>
                        
                        <!-- Tiêu đề -->
                        <h3 class="text-lg font-semibold mt-2 line-clamp-2">{{ $product->product_name }}</h3>
                        
                        <!-- Mô tả -->
                        <p class="text-gray-600 text-sm mt-1 flex-1 line-clamp-3">{{ $product->description }}</p>
                        
                        <!-- Giá -->
                        <p class="text-red-500 font-bold mt-2">{{ number_format($product->price, 0, ',', '.') }} đ</p>
                        
                        <!-- Nút Xem thêm -->
                        <a href="{{APP_URL .'sanpham/chitiet/'.$product->id}}" class="bg-purple-500 text-white py-2 px-4 rounded w-full block text-center mt-4 hover:bg-purple-600 transition duration-300">
                            Xem thêm
                        </a>
                    </div>
                @endforeach
            </div>
        </section> 
</div>
<script>
    const colorSelect = document.getElementById('color-select');
    const stockDisplay = document.getElementById('stock-display');
    const variantImage = document.getElementById('variant-image');

    // Cập nhật stock và ảnh ban đầu dựa trên option đầu tiên
    if (colorSelect.options.length > 0) {
        const initialOption = colorSelect.options[0];
        const initialStock = initialOption.getAttribute('data-stock');
        const initialImage = initialOption.getAttribute('data-image');

        stockDisplay.textContent = initialStock;
        variantImage.src = initialImage;
    }

    // Lắng nghe sự kiện thay đổi trên select
    colorSelect.addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        const stock = selectedOption.getAttribute('data-stock');
        const image = selectedOption.getAttribute('data-image');

        stockDisplay.textContent = stock;
        variantImage.src = image;
    });
</script>
@endsection

