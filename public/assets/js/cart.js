//alert("JS Giỏ hàng đã kết nối thành công!");
document.addEventListener('DOMContentLoaded', function() {
    
    const modalElem = document.getElementById('orderModal');
    let orderModal = null;
    if (modalElem) {
        orderModal = new bootstrap.Modal(modalElem);
    }

    const productImages = document.querySelectorAll('.product-img-container img');
    productImages.forEach(img => {
        img.addEventListener('error', function() {
            this.onerror = null; 
            this.src = 'https://via.placeholder.com/160x160?text=No+Image';
        });
    });

    document.body.addEventListener('click', function(e) {
        
        const btnAdd = e.target.closest('.btn-add-cart');
        if (btnAdd) {
            e.preventDefault();
            const productId = btnAdd.getAttribute('data-id');
            const isLogged = btnAdd.getAttribute('data-logged') === 'true';
            
            const qtyInput = document.getElementById('detail-quantity');
            const quantity = qtyInput ? parseInt(qtyInput.value) : 1;

            if (isLogged) {
                const formData = new FormData();
                formData.append('id', productId);
                formData.append('quantity', quantity); 
                sendCartData(formData);
            } else {
                const modalIdInput = document.getElementById('modal-product-id');
                if (modalIdInput) modalIdInput.value = productId; 
                
                const orderForm = document.getElementById('form-confirm-order');
                if (orderForm) orderForm.setAttribute('data-temp-qty', quantity); 
                
                orderModal.show();
            }
        }

        const btnUpdate = e.target.closest('.btn-update-qty');
        if (btnUpdate) {
            const id = btnUpdate.getAttribute('data-id');
            const type = btnUpdate.getAttribute('data-type'); 
            
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
                    location.reload(); 
                }
            })
            .catch(err => console.error("Lỗi cập nhật:", err));
        }

        const btnRemove = e.target.closest('.btn-remove-item');
        if (btnRemove) {
            e.preventDefault();
            const id = btnRemove.getAttribute('data-id');

            if (confirm('Bạn muốn bỏ món này khỏi giỏ hàng?')) {
                const formData = new FormData();
                formData.append('id', id);

                fetch('/web_ban_oc_pro/public/cart/remove', {
                    method: 'POST',
                    body: formData
                })
                .then(res => res.json())
                .then(data => {
                    if (data.status === 'success') {
                        location.reload(); 
                    } else {
                        alert(data.message);
                    }
                })
                .catch(err => console.error("Lỗi xóa:", err));
            }
        }
    });

    const orderForm = document.getElementById('form-confirm-order');
if (orderForm) {
    orderForm.addEventListener('submit', function(e) {
        e.preventDefault();

        const orderType = document.querySelector('input[name="orderType"]:checked').value;
        const tableNumber = document.getElementById('table-number').value;
        const address = document.getElementById('cust-address').value.trim();

        if (orderType === 'at_store' && tableNumber === "") {
            Swal.fire({
                icon: 'warning',
                title: 'Chưa chọn bàn!',
                text: 'Dat ơi, vui lòng chọn số bàn để quán phục vụ nhé.',
                confirmButtonColor: '#ff6600'
            });
            return false;
        }

        if (orderType === 'ship' && address === "") {
            Swal.fire({
                icon: 'warning',
                title: 'Thiếu địa chỉ!',
                text: 'Bạn vui lòng nhập địa chỉ để quán ship ốc tận nơi nha.',
                confirmButtonColor: '#ff6600'
            });
            return false;
        }

        const formData = new FormData(this);
        const tempQty = this.getAttribute('data-temp-qty') || 1;
        formData.set('quantity', tempQty); 

        sendCartData(formData);
        
        if (orderModal) orderModal.hide();
    });
}

    const typeShip = document.getElementById('typeShip');
    const typeAtStore = document.getElementById('typeAtStore');
    const addressGroup = document.getElementById('address-group');
    const tableGroup = document.getElementById('table-group'); 

    if (typeShip && typeAtStore) {
        typeShip.addEventListener('change', () => {
            addressGroup?.classList.remove('d-none'); 
            tableGroup?.classList.add('d-none');      
        });

        typeAtStore.addEventListener('change', () => {
            addressGroup?.classList.add('d-none');    
            tableGroup?.classList.remove('d-none');  
        });
    }
});


function sendCartData(formData) {
    fetch('/web_ban_oc_pro/public/cart/add', {
        method: 'POST',
        body: formData
    })
    .then(res => res.json())
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
$('input[name="orderType"]').change(function() {
    if (this.value === 'at_store') {
        $('#table-group').removeClass('d-none');
        $('#address-group').addClass('d-none');
        $('#table-number').attr('required', true);
        $('#cust-address').removeAttr('required');
    } else {
        $('#table-group').addClass('d-none');
        $('#address-group').removeClass('d-none');
        $('#cust-address').attr('required', true);
        $('#table-number').removeAttr('required');
    }
});
document.addEventListener('DOMContentLoaded', function() {
    const btnCheckout = document.getElementById('btn-checkout'); 

    if (btnCheckout) {
        btnCheckout.addEventListener('click', function(e) {
            e.preventDefault();

            this.innerHTML = '<i class="fas fa-spinner fa-spin"></i> ĐANG GỬI ĐƠN...';
            this.disabled = true;

            fetch('/web_ban_oc_pro/public/order/checkout', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                }
            })
            .then(res => res.json())
            .then(data => {
                if (data.status === 'success') {
                    alert('Đã gửi đơn hàng thành công! Quán ốc SV đang chuẩn bị món cho bạn.');
                    window.location.href = '/web_ban_oc_pro/public/order/success';
                } else {
                    alert('Lỗi: ' + data.message);
                    this.innerHTML = 'GỬI ĐƠN HÀNG NGAY';
                    this.disabled = false;
                }
            })
            .catch(err => {
                console.error('Lỗi rồi:', err);
                alert('Mạng lag hoặc Server tèo rồi cha nội ơi!');
                this.innerHTML = 'GỬI ĐƠN HÀNG NGAY';
                this.disabled = false;
            });
        });
    }
});