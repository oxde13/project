// Функция для загрузки товаров в корзине
function loadCartItems() {
    fetch('cart.php')
        .then(response => response.json())
        .then(cartItems => {
            const cartSection = document.getElementById('cart-items');
            cartSection.innerHTML = ''; // Очистка перед добавлением товаров

            if (cartItems.length === 0) {
                cartSection.innerHTML = '<p>Корзина пуста</p>';
                return;
            }

            let total = 0;
            cartItems.forEach(item => {
                const itemDiv = document.createElement('div');
                itemDiv.className = 'cart-item';

                const itemTotal = item.price * item.quantity;
                total += itemTotal;

                itemDiv.innerHTML = `
                    <span>${item.name}</span>
                    <span>Цена: ${item.price} руб.</span>
                    <span>Количество: ${item.quantity}</span>
                    <span>Всего: ${itemTotal} руб.</span>
                `;

                cartSection.appendChild(itemDiv);
            });

            // Добавляем итоговую стоимость
            const totalDiv = document.createElement('div');
            totalDiv.className = 'cart-total';
            totalDiv.innerHTML = `<strong>Итого: ${total} руб.</strong>`;
            cartSection.appendChild(totalDiv);
        })
        .catch(error => console.error('Ошибка при загрузке корзины:', error));
}

// Загружаем корзину при загрузке страницы
document.addEventListener('DOMContentLoaded', loadCartItems);