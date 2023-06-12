/** 
 * Удалит все статусы запросов
 * 
 * [data-status-delete-all] - DOM кнопка для удаления
 */
document.querySelector('[data-status-delete-all]')?.addEventListener('click', async e => {
    e.preventDefault()

    if (confirm('Подтвердите удаление')) {
        try {
            const response = await fetch(`/parser/status`, {
                method: "DELETE",
                headers: {
                    "Content-Type": "application/json",
                    'X-CSRF-TOKEN': CSRF
                },
            });

            const result = await response.json();
            if (result) {
                location.reload()
            }
        } catch (error) {
            console.error(error);
        }
    }
})
