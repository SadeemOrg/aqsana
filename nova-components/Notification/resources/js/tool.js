Nova.booting((Vue, router, store) => {
  router.addRoutes([
    {
      name: 'notification',
      path: '/notification',
      component: require('./components/Tool'),
    },
  ])
})
