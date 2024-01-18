function submitForm() {
    document.getElementById('productForm').submit();
}
function searchProducts() {
    const searchTerm = document.getElementById('search').value.trim().toUpperCase();
    const productList = document.getElementById('productList');
    const items = productList.querySelectorAll('.form-item');
    items.forEach(item => {
        const itemName = item.getAttribute('data-name').toUpperCase();
        const itemPrijs = item.getAttribute('data-prijs').toUpperCase();
        const itemCategorie = item.getAttribute('data-categorie').toUpperCase();
        if (itemName.includes(searchTerm) || itemPrijs.includes(searchTerm) || itemCategorie.includes(searchTerm)) {
            item.style.display = '';
        } else {
            item.style.display = 'none';
        }
    });
    return false; 
}
document.getElementById('search').addEventListener('input', searchProducts);
searchProducts();