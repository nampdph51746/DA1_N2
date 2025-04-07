@extends('Client.layout')

@section('content')
<div class="container max-w-screen-xl m-auto grid grid-cols-12 gap-8 my-8">
    <div class="col-span-8">
        <table class="w-full">
            <thead>
                <tr class="bg-neutral-100 *:py-4 font-medium">
                    <th class="text-left pl-4">Sản phẩm</th>
                    <th>Màu</th>
                    <th>Giá</th>
                    <th>Số lượng</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($cart as $key => $item)
                <tr class="*:py-4 *:text-center *:font-medium">
                    <td class="!text-left">
                        <img src="{{ APP_URL . $item['image'] }}" style="width: 70px; height: 70px;" alt="{{ $item['name'] }}" class="inline mr-4">
                        <span class="font-medium text-neutral-600">{{ $item['name'] }}</span>
                    </td>
                    <td class="text-neutral-600">{{ $item['color'] }}</td>
                    <td class="text-neutral-600">{{ number_format($item['price'], 0, ',', '.') }} VND</td>
                    <td class="text-neutral-600">
                        <form class="decrease-quantity-form" method="POST" action="{{ APP_URL }}/decrease-quantity" style="display: inline;">
                            <input type="hidden" name="cart_key" value="{{ $key }}">
                            <button type="submit" class="mr-2 text-red-500">-</button>
                        </form>
                        <span class="quantity" data-key="{{ $key }}">{{ $item['quantity'] }}</span>
                        <form class="increase-quantity-form" method="POST" action="{{ APP_URL }}/increase-quantity" style="display: inline;">
                            <input type="hidden" name="cart_key" value="{{ $key }}">
                            <button type="submit" class="ml-2 text-green-500">+</button>
                        </form>
                    </td>
                    <td>
                        <!-- Thay <a> bằng form -->
                        <form class="remove-from-cart-form" method="POST" action="{{ APP_URL }}/remove-from-cart" style="display: inline;">
                            <input type="hidden" name="cart_key" value="{{ $key }}">
                            <button type="submit" class="material-icons text-red-500">delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center py-4">Giỏ hàng trống</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="col-span-4 bg-neutral-100 p-8 rounded-lg">
        <h2 class="font-semibold text-2xl mb-4">Thông tin giỏ hàng</h2>
        <hr class="border-[#A3A3A3] mb-5">
        
        <?php
            $subtotal = 0;
            foreach ($cart as $item) {
                $subtotal += $item['price'] * $item['quantity'];
            }
            $discount = $_SESSION['applied_voucher']['discount'] ?? 0;
            $total = max($subtotal - $discount, 0);
        ?>
        <div class="flex justify-between text-lg font-medium mb-3">
            <span>Tạm tính:</span>
            <span class="text-neutral-600 subtotal">{{ number_format($subtotal, 0, ',', '.') }} đ</span>
        </div>
        
        <div class="flex justify-between text-lg font-medium mb-3">
            <span>Giảm giá:</span>
            <span id="discount-value" class="text-red-500">{{ number_format($discount, 0, ',', '.') }} đ</span>
        </div>

        <div class="flex items-center mb-4">
            <input id="discount-code" type="text" placeholder="Nhập mã giảm giá" class="p-2 border border-gray-300 rounded-md flex-grow mr-2">
            <button id="apply-discount" class="bg-yellow-600 text-white py-2 px-4 rounded-md hover:bg-yellow-700">
                Áp dụng
            </button>
        </div>
        
        <hr class="border-[#A3A3A3] my-5">
        
        <div class="flex justify-between text-xl font-semibold mb-5">
            <span>Tổng cộng:</span>
            <span id="total-amount" class="text-green-600">{{ number_format($total, 0, ',', '.') }} đ</span>
        </div>
        
        <a href="{{ APP_URL }}/payment" class="w-full bg-yellow-600 text-white py-3 text-lg font-semibold rounded-md hover:bg-yellow-700 block text-center">
            Tiến hành thanh toán
        </a>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const formatter = new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' });
    const appliedVoucherCode = "{{ $_SESSION['applied_voucher']['code'] ?? '' }}";

    function updateTotal(subtotal, discountElement) {
        const discount = parseFloat(discountElement.textContent.replace(/[^0-9]/g, '')) || 0;
        const newTotal = Math.max(subtotal - discount, 0);
        document.getElementById('total-amount').textContent = formatter.format(newTotal);
    }

    function reapplyVoucher(voucherCode) {
        if (!voucherCode) return;

        fetch("{{ APP_URL }}/apply-voucher", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify({ voucher_code: voucherCode })
        })
        .then(response => response.json())
        .then(data => {
            console.log('Reapplied voucher:', data);
            if (data.success) {
                document.getElementById('discount-value').textContent = '-' + formatter.format(data.discount);
                document.getElementById('total-amount').textContent = formatter.format(data.total);
            }
        })
        .catch(error => console.error('Error reapplying voucher:', error));
    }

    document.querySelectorAll('.increase-quantity-form').forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            const quantitySpan = this.parentElement.querySelector('.quantity');
            const cartKey = formData.get('cart_key');

            fetch('{{ APP_URL }}/increase-quantity', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    quantitySpan.textContent = data.quantity;
                    document.querySelector('.subtotal').textContent = formatter.format(data.total);
                    updateTotal(data.total, document.getElementById('discount-value'));

                    if (appliedVoucherCode) {
                        reapplyVoucher(appliedVoucherCode);
                    }
                } else {
                    alert(data.message);
                }
            })
            .catch(error => {
                console.error('Error (increase):', error);
                alert('Có lỗi xảy ra khi tăng số lượng');
            });
        });
    });

    document.querySelectorAll('.decrease-quantity-form').forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            const quantitySpan = this.parentElement.querySelector('.quantity');
            const row = this.closest('tr');

            fetch('{{ APP_URL }}/decrease-quantity', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    if (data.quantity === 0) {
                        row.remove();
                        if (!document.querySelector('tbody tr')) {
                            document.querySelector('tbody').innerHTML = '<tr><td colspan="5" class="text-center py-4">Giỏ hàng trống</td></tr>';
                        }
                    } else {
                        quantitySpan.textContent = data.quantity;
                    }

                    document.querySelector('.subtotal').textContent = formatter.format(data.total);
                    updateTotal(data.total, document.getElementById('discount-value'));

                    if (appliedVoucherCode) {
                        reapplyVoucher(appliedVoucherCode);
                    }
                } else {
                    alert(data.message);
                }
            })
            .catch(error => {
                console.error('Error (decrease):', error);
                alert('Có lỗi xảy ra khi giảm số lượng');
            });
        });
    });

    document.querySelectorAll('.remove-from-cart-form').forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            const row = this.closest('tr');

            fetch('{{ APP_URL }}/remove-from-cart', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    row.remove();
                    if (!document.querySelector('tbody tr')) {
                        document.querySelector('tbody').innerHTML = '<tr><td colspan="5" class="text-center py-4">Giỏ hàng trống</td></tr>';
                    }

                    document.querySelector('.subtotal').textContent = formatter.format(data.total);
                    updateTotal(data.total, document.getElementById('discount-value'));

                    if (appliedVoucherCode) {
                        reapplyVoucher(appliedVoucherCode);
                    }
                } else {
                    alert(data.message);
                }
            })
            .catch(error => {
                console.error('Error (remove):', error);
                alert('Có lỗi xảy ra khi xóa sản phẩm');
            });
        });
    });

    document.getElementById('apply-discount').addEventListener('click', function() {
        const voucherCode = document.getElementById('discount-code').value;

        fetch("{{ APP_URL }}/apply-voucher", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify({ voucher_code: voucherCode })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.getElementById('discount-value').textContent = '-' + formatter.format(data.discount);
                document.getElementById('total-amount').textContent = formatter.format(data.total);
            } else {
                alert(data.message);
            }
        })
        .catch(error => {
            console.error('Error (apply-discount):', error);
            alert('Có lỗi xảy ra khi áp dụng mã giảm giá');
        });
    });
});

document.querySelector('.bg-yellow-600[href="/payment"]').addEventListener('click', function(e) {
    const cartRows = document.querySelectorAll('tbody tr:not([class])');
    if (cartRows.length === 0) {
        e.preventDefault();
        alert('Giỏ hàng trống, vui lòng thêm sản phẩm trước khi thanh toán!');
    }
});
</script>
@endsection