<?php if (!empty($products)): ?>
    <div class="list-group shadow-lg">
        <?php foreach ($products as $item): ?>
            <a href="/web_ban_oc_pro/public/product/detail/<?= $item['slug'] ?>" 
               class="list-group-item list-group-item-action d-flex align-items-center p-2">
                <img src="/web_ban_oc_pro/public/assets/uploads/products/<?= $item['image'] ?>" 
                     style="width: 50px; height: 50px; object-fit: cover;" class="rounded me-3">
                <div>
                    <div class="fw-bold small"><?= $item['name'] ?></div>
                    <div class="text-danger small"><?= number_format($item['price'], 0, ',', '.') ?>đ</div>
                </div>
            </a>
        <?php endforeach; ?>
    </div>
<?php endif; ?>