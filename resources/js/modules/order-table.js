/**
 * Сортирока таблицы 
 * 
 * [data-table-order-row] - Поле по которому будет производиться сортировка. Присваивается TH
 */

/** Определили объект с сортировкой для таблиц */
if (!localStorage.order_table || !location.search) {
    localStorage.order_table = JSON.stringify({})
}

const storage = JSON.parse(localStorage.order_table)

document.querySelectorAll('[data-table-order-row]').forEach(elem => {
    const order_row = elem.dataset.tableOrderRow
    elem.classList.add(storage[order_row])

    elem.addEventListener('click', () => {


        if (storage[order_row] == 'asc')
            storage[order_row] = 'desc'
        else
            storage[order_row] = 'asc'

        localStorage.order_table = JSON.stringify(storage)
        location.href = `${location.origin + location.pathname}?order=${order_row}&sort=${storage[order_row]}`
    })
})
