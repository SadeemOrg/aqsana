Nova.booting((Vue, router, store) => {
  router.addRoutes([
    {
      name: 'projecs',
      path: '/projecs',
      component: require('./components/Tool'),
    },
  ])
})
