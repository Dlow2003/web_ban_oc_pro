document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.querySelector('input[name="search"]');
    const resultBox = document.getElementById('search-results');

    if (searchInput && resultBox) {
        searchInput.addEventListener('input', function() {
            const query = this.value.trim();
            if (query.length < 2) {
                resultBox.innerHTML = ''; 
                return;
            }

            fetch(`api/search?search=${encodeURIComponent(query)}`)
                .then(response => response.text())
                .then(html => {
                    resultBox.innerHTML = html;
                })
                .catch(err => console.error("Lỗi Live Search:", err));
        });

        document.addEventListener('click', function(e) {
            if (!searchInput.contains(e.target) && !resultBox.contains(e.target)) {
                resultBox.innerHTML = '';
            }
        });
    }
});