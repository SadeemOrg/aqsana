Nova.booting((Vue, router, store) => {
  Vue.component('index-link-field', require('./components/IndexField'))
  Vue.component('detail-link-field', require('./components/DetailField'))
  Vue.component('form-link-field', require('./components/FormField'))
})
