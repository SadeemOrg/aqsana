Nova.booting((Vue, router, store) => {
  Vue.component('index-sector-picker', require('./components/IndexField'))
  Vue.component('detail-sector-picker', require('./components/DetailField'))
  Vue.component('form-sector-picker', require('./components/FormField'))
})
