Nova.booting((Vue, router, store) => {
  router.addRoutes([
    {
      name: 'report-regulation',
      path: '/report-regulation',
      component: require('./components/Tool'),
    },
  ])
})
