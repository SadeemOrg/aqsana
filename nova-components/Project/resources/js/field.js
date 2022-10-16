Nova.booting((Vue, router, store) => {
  Vue.component('index-project', require('./components/IndexField'))
  Vue.component('detail-project', require('./components/DetailField'))
  Vue.component('form-project', require('./components/FormField'))
})
