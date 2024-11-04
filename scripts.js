// Показать форму для отзыва
function showReviewForm() {
    document.getElementById("review-form").style.display = "flex";
}

// Закрыть форму для отзыва
function closeReviewForm() {
    document.getElementById("review-form").style.display = "none";
}

// Валидация формы для отзыва
function validateReviewForm() {
    const name = document.getElementById("name").value.trim();
    const product = document.getElementById("product").value.trim();
    const review = document.getElementById("review").value.trim();

    if (!name || !product || !review) {
        alert("Пожалуйста, заполните все поля.");
        return false;
    }
    return true;
}
