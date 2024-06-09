Nova.booting((Vue, router, store) => {
  Vue.component('index-number-field', require('./components/IndexField'))
  Vue.component('detail-number-field', require('./components/DetailField'))
  Vue.component('form-number-field', require('./components/FormField'))
})
