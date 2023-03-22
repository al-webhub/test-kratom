export const useMenu = () => {
  const { t } = useI18n({useScope: 'global'})

  const menu = {
    shop: {
      id: 0,
      link: '/shop',
      name: t('title.item_1'),
      items: []
    },
    rewards: {
      id: 2,
      link: '/rewards',
      name: t('title.item_3')
    },
    pay_delivery: {
      id: 3,
      link: '/pay_delivery',
      name: t('title.item_4')
    },
    reviews: {
      id: 4,
      link: '/reviews',
      name: t('title.item_5')
    },
    contacts: {
      id: 5,
      link: '/contacts',
      name: t('title.item_9')
    },
    guidebook: {
      id: 6,
      link: '/guidebook',
      name: t('title.item_6')
    },
    about_us: {
      id: 7,
      link: '/about_us',
      name: t('title.item_7')
    },
    advantages: {
      id: 8,
      link: '/our-advantages',
      name: t('title.advantages')
    },
    faq: {
      id: 9,
      link: '/faq',
      name: t('title.item_8')
    }
  }

  return {
    menu
  }
}