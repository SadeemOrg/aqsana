Nova.booting((Vue, router, store) => {
  Vue.component('form-index-tree', require('./components/IndexField'))
  Vue.component('form-detail-tree', require('./components/DetailField'))
  Vue.component('form-tree-field', require('./components/FormField'))
})
