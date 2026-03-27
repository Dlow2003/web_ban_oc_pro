document.addEventListener('DOMContentLoaded', function() {
    const btnCheckout = document.getElementById('btn-checkout');

    if (btnCheckout) {
        btnCheckout.addEventListener('click', function() {
            const originalText = this.innerHTML;
            this.disabled = true;
            this.innerHTML = '<i class="fas fa-spinner fa-spin"></i> ĐANG CHỐT ĐƠN...';

            fetch('/web_ban_oc_pro/public/order/checkout', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                }
            })
            .then(res => res.json())
            .then(data => {
                if (data.status === 'success') {
                    alert('Cảm ơn bạn đơn hàng đã được quán ghi nhận.');
                    window.location.href = '/web_ban_oc_pro/public/order/success';
                } else {
                    alert('Lỗi: ' + data.message);
                    this.disabled = false;
                    this.innerHTML = originalText;
                }
            })
            .catch(err => {
                console.error('Lỗi:', err);
                alert('Có lỗi xảy ra, bạn kiểm tra lại máy ảo nhé!');
                this.disabled = false;
                this.innerHTML = originalText;
            });
        });
    }
});