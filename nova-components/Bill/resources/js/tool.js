Nova.booting((Vue, router, store) => {
  router.addRoutes([
    {
      name: 'bill',
      path: '/bill',
      component: require('./components/Tool'),
    },
  ])
})
