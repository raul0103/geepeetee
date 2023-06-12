import './modules/order-table'

window.CSRF = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content')
