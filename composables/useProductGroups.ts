export const useProductGroups = () => {
  const { t } = useI18n({useScope: 'global'})

  const groups = [
    // {
    //   name: t('filter.region'),
    //   items: [
    //     {
    //       name: t('filter.thai'),
    //       link: '/shop/thai-kratom'
    //     },{
    //       name: t('filter.borneo'),
    //       link: '/shop/borneo-kratom'
    //     },{
    //       name: t('filter.sumatra'),
    //       link: '/shop/sumatra-kratom'
    //     },{
    //       name: t('filter.malay'),
    //       link: '/shop/malay-kratom'
    //     }
    //   ]
    // },
    {
      name: t('filter.color'),
      items: [
        {
          name: t('filter.white'),
          link: '/shop/white-kratom'
        },{
          name: t('filter.red'),
          link: '/shop/red-kratom'
        },{
          name: t('filter.green'),
          link: '/shop/green-kratom'
        }
      ]
    },
    {
      name: t('filter.type'),
      items: [
        {
          name: t('filter.seed'),
          link: '/shop/kratom-in-seeds'
        },{
          name: t('filter.pills'),
          link: '/shop/kratom-in-pills'
        },{
          name: t('filter.powder'),
          link: '/shop/kratom-powder'
        },{
          name: t('filter.leaves'),
          link: '/shop/crushed-kratom-leaves'
        }
      ]
    }
  ]

  return groups
}