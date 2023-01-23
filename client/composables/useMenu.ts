export const useMenu = () => {
  const { t } = useI18n({useScope: 'global'})

  const menu = {
    shop: {
      id: 0,
      link: '/shop',
      name: t('title.item_1'),
      items: [],
      observed: false
    },
    rewards: {
      id: 2,
      link: '/rewards',
      name: t('title.item_3'),
      observed: false
    },
    pay_delivery: {
      id: 3,
      link: '/pay_delivery',
      name: t('title.item_4'),
      observed: false
    },
    reviews: {
      id: 4,
      link: '/reviews',
      name: t('title.item_5'),
      observed: false
    },
    contacts: {
      id: 5,
      link: '/contacts',
      name: t('title.item_9'),
      observed: false
    },
    guidebook: {
      id: 6,
      link: '/guidebook',
      name: t('title.item_6'),
      observed: false
    },
    about_us: {
      id: 7,
      link: '/about_us',
      name: t('title.item_7'),
      observed: false
    },
    faq: {
      id: 8,
      link: '/faq',
      name: t('title.item_8'),
      observed: false
    },
    // menu: {
    //   id: 'menu',
    //   link: null,
    //   name: t('title.menu'),
    //   items: [],
    //   observed: false
    // },
  }

  return {
    menu
  }
}