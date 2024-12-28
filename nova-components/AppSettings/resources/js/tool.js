Nova.booting((Vue, router, store) => {
  router.addRoutes([
    {
      name: 'app-settings',
      path: '/app-settings',
      component: require('./components/Tool'),
    },
  ])
})
