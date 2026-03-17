document.addEventListener('DOMContentLoaded', function() {
    // 1. Khởi tạo Modal
    const modalElem = document.getElementById('orderModal');
    let orderModal = null;
    if (modalElem) {
        orderModal = new bootstrap.Modal(modalElem);
    }

    // 2. Xử lý lỗi ảnh sản phẩm (Dọn dẹp báo đỏ ở file PHP)
    const productImages = document.querySelectorAll('.product-img-container img');
    productImages.forEach(img => {
        img.addEventListener('error', function() {
            this.onerror = null; // Ngăn vòng lặp vô tận
            this.src = 'https://via.placeholder.com/160x160?text=No+Image';
        });
    });

    // Trong cart.js
document.body.addEventListener('click', function(e) {
    const btn = e.target.closest('.btn-add-cart');
    if (!btn) return;

    e.preventDefault();
    const productId = btn.getAttribute('data-id');
    const isLogged = btn.getAttribute('data-logged') === 'true';
    
    // Lấy số lượng từ ô input (nếu ở trang chi tiết)
    const qtyInput = document.getElementById('detail-quantity');
    const quantity = qtyInput ? parseInt(qtyInput.value) : 1;

    if (isLogged) {
        const formData = new FormData();
        formData.append('id', productId);
        formData.append('quantity', quantity); // Gửi số lượng khách chọn
        sendCartData(formData);
    } else {
        // ... (Đoạn code hiện Modal giữ nguyên) ...
        // Nhưng nhớ lưu quantity vào form để dùng khi submit modal
        document.getElementById('form-confirm-order').setAttribute('data-temp-qty', quantity);
        orderModal.show();
    }
});
// Xử lý tăng giảm số lượng
document.body.addEventListener('click', function(e) {
    const btn = e.target.closest('.btn-update-qty');
    if (btn) {
        const id = btn.getAttribute('data-id');
        const type = btn.getAttribute('data-type'); // 'plus' hoặc 'minus'
        
        const formData = new FormData();
        formData.append('id', id);
        formData.append('type', type);

        fetch('/web_ban_oc_pro/public/cart/update', {
            method: 'POST',
            body: formData
        })
        .then(res => res.json())
        .then(data => {
            if (data.status === 'success') {
                // 1. Cập nhật ô input số lượng của dòng đó
                const row = document.getElementById(`cart-item-${id}`);
                row.querySelector('input').value = data.newQty;

                // 2. Cập nhật thành tiền của món đó
                // Dat nhớ bọc số tiền vào 1 thẻ có class 'item-total' nhé
                row.querySelector('.item-total').innerText = data.itemTotal;

                // 3. Cập nhật tổng tiền cả giỏ hàng
                document.getElementById('cart-total-price').innerText = data.cartTotal;
            }
        })
        .catch(err => console.error("Lỗi:", err));
    }
});


const orderForm = document.getElementById('form-confirm-order');
if (orderForm) {
    orderForm.addEventListener('submit', function(e) {
        e.preventDefault();
        const formData = new FormData(this); 
        
        formData.append('id', document.getElementById('modal-product-id').value);
        
        const tempQty = this.getAttribute('data-temp-qty') || 1;
        formData.append('quantity', tempQty);
        
        const tableNum = document.getElementById('table-number');
        if (tableNum) formData.append('table_number', tableNum.value);

        sendCartData(formData);
    });
}

    // 5. Hiện/Ẩn địa chỉ & số bàn khi chọn Ship/Tại quán
    const typeShip = document.getElementById('typeShip');
    const typeAtStore = document.getElementById('typeAtStore');
    const addressGroup = document.getElementById('address-group');
    const tableGroup = document.getElementById('table-group'); 

    if (typeShip && typeAtStore) {
        typeShip.addEventListener('change', () => {
            if(addressGroup) addressGroup.classList.remove('d-none'); 
            if(tableGroup) tableGroup.classList.add('d-none');      
        });

        typeAtStore.addEventListener('change', () => {
            if(addressGroup) addressGroup.classList.add('d-none');    
            if(tableGroup) tableGroup.classList.remove('d-none');  
        });
    }
});

// Hàm gửi dữ liệu tập trung
function sendCartData(formData) {
    fetch('/web_ban_oc_pro/public/cart/add', {
        method: 'POST',
        body: formData
    })
    .then(res => {
        if (!res.ok) throw new Error('Network response was not ok');
        return res.json();
    })
    .then(data => {
        if (data.status === 'success') {
            alert(data.message);
            location.reload(); 
        } else {
            alert("Lỗi: " + data.message);
        }
    })
    .catch(err => {
        console.error("Lỗi Fetch:", err);
        alert("Không thể kết nối đến máy chủ. Vui lòng kiểm tra lại XAMPP!");
    });
}
// Xử lý xóa món khỏi giỏ
document.addEventListener('click', function(e) {
    const btn = e.target.closest('.btn-remove-item');
    if (btn) {
        e.preventDefault();
        const id = btn.getAttribute('data-id');
        console.log("Đang muốn xóa món có ID:", id); // Kiểm tra xem JS có chạy vào đây không

        if (confirm('Bỏ món này nhé?')) {
            const formData = new FormData();
            formData.append('id', id);

            fetch('/web_ban_oc_pro/public/cart/remove', {
                method: 'POST',
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                console.log("Kết quả từ Server:", data);
                if (data.status === 'success') {
                    location.reload(); // Cách đơn giản nhất: Reload lại để thấy kết quả xóa
                } else {
                    alert(data.message);
                }
            })
            .catch(err => console.error("Lỗi Fetch:", err));
        }
    }
});