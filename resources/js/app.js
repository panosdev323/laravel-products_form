require('./bootstrap');

document.addEventListener("DOMContentLoaded", () => {
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    document.querySelector("#productForm").addEventListener("submit", function(e) {
        e.preventDefault();

        const product_name = document.querySelector("#productName").value;
        const quantity_stock = parseInt(document.querySelector("#quantityStock").value, 10);
        const item_price = parseFloat(document.querySelector("#itemPrice").value);

        const data = {
            productName: product_name,
            quantityStock: quantity_stock,
            itemPrice: item_price
        };

        fetch('/products', {
            method: "POST",
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify(data)
        })
        .then(response => {
            if (response.redirected) {
                console.error('Redirected to:', response.url);
                throw new Error('Unexpected redirect');
            }
            if (!response.ok) {
                return response.text(); // Get the response text for debugging
            }
            return response.json();
        })
        .then(data => {
            document.getElementById('responseMessage').innerText = data.success;
            document.getElementById('productForm').reset();
            // update table
            const tbody = document.getElementById('productTableBody');
            tbody.innerHTML = '';
            data.products.forEach(product => {
                const row = `<tr>
                    <td>${product.product_name}</td>
                    <td>${product.quantity_stock}</td>
                    <td>${product.item_price}</td>
                    <td>${product.created_at}</td>
                    <td>${(product.quantity_stock * product.item_price).toFixed(2)}</td>
                </tr>`;
                tbody.insertAdjacentHTML('beforeend', row);
            });
        })
        .catch(error => {
            console.error('Error:', error);
        });
    });
});