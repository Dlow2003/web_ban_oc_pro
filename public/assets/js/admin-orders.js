document.addEventListener('DOMContentLoaded', function() {
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.get('msg') === 'updated') {
        Swal.fire({
            icon: 'success',
            title: 'Thành công!',
            text: 'Trạng thái đơn hàng đã được cập nhật.',
            timer: 2000,
            showConfirmButton: false
        });
    }

    const selects = document.querySelectorAll('.status-select');
    selects.forEach(select => {
        select.addEventListener('change', function(e) {
            const form = this.form; 
            const statusText = this.options[this.selectedIndex].text;
            const statusValue = this.value;

            const swalConfig = {
                title: 'Xác nhận cập nhật?',
                text: `Bạn muốn đổi đơn này sang: "${statusText}"?`,
                icon: statusValue === 'cancelled' ? 'warning' : 'question',
                showCancelButton: true,
                confirmButtonColor: statusValue === 'cancelled' ? '#d33' : '#3085d6',
                cancelButtonColor: '#aaa',
                confirmButtonText: 'Đồng ý',
                cancelButtonText: 'Hủy'
            };

            Swal.fire(swalConfig).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                } else {
                    location.reload();
                }  
            });
        });
    });
});