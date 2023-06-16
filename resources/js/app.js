import './modules/order-table'
import './modules/confirmation'

window.CSRF = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content')
