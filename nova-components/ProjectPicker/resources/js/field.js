Nova.booting((Vue, router, store) => {
  Vue.component('index-project-picker', require('./components/IndexField'))
  Vue.component('detail-project-picker', require('./components/DetailField'))
  Vue.component('form-project-picker', require('./components/FormField'))
})
