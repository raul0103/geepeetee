/**
 * Скрипт на кнопках просит поддтвердить действие
 * 
 * [data-confirmation] - Определяет кнопку
 * [data-confirmation-text] - Задает текст для окна подтверждения
 */
document.querySelectorAll('[data-confirmation]').forEach(elem => {
    elem.addEventListener('click', e => {
        if (!confirm(e.target.dataset.confirmationText ?? 'Подтвердите действие')) e.preventDefault();
    }, false);
})
