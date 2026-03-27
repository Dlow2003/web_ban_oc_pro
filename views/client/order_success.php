<div class="container text-center my-5 py-5">
    <div class="mb-4">
        <i class="fas fa-check-circle text-success" style="font-size: 80px;"></i>
    </div>
    <h2 class="fw-bold">ĐẶT MÓN THÀNH CÔNG!</h2>
    <p class="text-muted">
    Cảm ơn <b><?php echo htmlspecialchars($_SESSION['user']['name'] ?? 'bạn'); ?></b>, 
    quán Ốc SV đã nhận được đơn hàng của bạn.
</p>
    <div class="mt-4">
        <a href="/web_ban_oc_pro/public/" class="btn btn-orange rounded-pill px-4 py-2 text-white">
            Tiếp tục mua hàng
        </a>
        <a href="/web_ban_oc_pro/public/order/history" class="btn btn-outline-secondary rounded-pill px-4 py-2 ms-2">
            Xem lịch sử đơn hàng
        </a>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.5.1/dist/confetti.browser.min.js"></script>
<script>
    confetti({
        particleCount: 150,
        spread: 70,
        origin: { y: 0.6 },
        colors: ['#ff6600', '#28a745', '#ffffff'] 
    });
</script>