Nova.booting((Vue, router, store) => {
  Vue.component('index-bookings-bus', require('./components/IndexField'))
  Vue.component('detail-bookings-bus', require('./components/DetailField'))
  Vue.component('form-bookings-bus', require('./components/FormField'))
})
