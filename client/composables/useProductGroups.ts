export const useProductGroups = () => {
  const { t } = useI18n({
    messages: {
      en: {
        region: "Regions",
        color: "Color",
        type: "Type",
        thai: "Thai kratom",
        borneo: "Borneo kratom",
        sumatra: "Sumatra kratom",
        malay: "Malay kratom",
        white: "White kratom",
        red: "Red kratom",
        green: "Green kratom",
        seed: "Kratom in seeds",
        pills: "Kratom in pills",
        powder: "Kratom powder"
      },
      ru: {
        region: "Регион",
        color: "Цвет",
        type: "Тип",
        thai: "Тайланд",
        borneo: "Борнео",
        sumatra: "Суматра",
        malay: "Малайзия",
        white: "Белый кратом",
        red: "Красный кратом",
        green: "Заленый кратом",
        seed: "Кратом в зернах",
        pills: "Кратом в таблетках",
        powder: "Кратом - порошок"
      }
    }
  })

  const groups = [
    {
      name: t('region'),
      items: [
        {
          name: t('thai'),
          link: '/shop/thai-kratom'
        },{
          name: t('borneo'),
          link: '/shop/borneo-kratom'
        },{
          name: t('sumatra'),
          link: '/shop/sumatra-kratom'
        },{
          name: t('malay'),
          link: '/shop/malay-kratom'
        }
      ]
    },{
      name: t('color'),
      items: [
        {
          name: t('white'),
          link: '/shop/white-kratom'
        },{
          name: t('red'),
          link: '/shop/red-kratom'
        },{
          name: t('green'),
          link: '/shop/green-kratom'
        }
      ]
    },{
      name: t('type'),
      items: [
        {
          name: t('seed'),
          link: '/shop/kratom-in-seeds'
        },{
          name: t('pills'),
          link: '/shop/kratom-in-pills'
        },{
          name: t('powder'),
          link: '/shop/kratom-powder'
        }
      ]
    }
  ]

  return groups
}