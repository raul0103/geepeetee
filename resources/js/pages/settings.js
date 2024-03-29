/** 
 * Удалит API ключ
 * 
 * [data-delete-api-key] - DOM кнопка для удаления с ID удаляемого объекта
 */
document.querySelectorAll('[data-delete-api-key]').forEach(btn => {
    btn.addEventListener('click', async e => {
        e.preventDefault()

        const api_key_id = e.target.dataset.deleteApiKey

        if (confirm('Подтвердите удаление')) {
            try {
                const response = await fetch(`/settings/gpt-api-keys/${api_key_id}`, {
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
})
