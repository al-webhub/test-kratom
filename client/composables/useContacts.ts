

import pinIcon from '/assets/svg-icons/pin.svg';
import phoneIcon from '/assets/svg-icons/phone.svg';
import mailIcon from '/assets/svg-icons/mail.svg';
import telegramIcon from '/assets/svg-icons/telegram.svg';
import whatsappIcon from '/assets/svg-icons/whatsapp.svg';
import skypeIcon from '/assets/svg-icons/skype.svg';
import viberIcon from '/assets/svg-icons/viber.svg';

export const useContacts = () => {
  const nuxtApp = useNuxtApp()

  const items = useState('contacts', () => {})

  items.value = {
    address: {
      link: '/',
      icon: pinIcon,
      text: nuxtApp.$i18n.t('contacts.address')
    },
    email: {
      icon: mailIcon,
      link: `mailto:${nuxtApp.$i18n.t('contacts.email')}`,
      text: nuxtApp.$i18n.t('contacts.email')
    },
    phone: {
      icon: phoneIcon,
      link: `tel:${nuxtApp.$i18n.t('contacts.phone')}`,
      text: nuxtApp.$i18n.t('contacts.phone')
    },
    telegram: {
      icon: telegramIcon,
      link: 'tg://resolve?domain=',
      text: 'telegram',
    },
    whatsapp: {
      icon: whatsappIcon,
      link: 'https://wa.me/',
      text: 'whatsapp',
    },
    skype: {
      icon: skypeIcon,
      link: 'skype:?chat',
      text: 'skype',
    },
    viber: {
      icon: viberIcon,
      link: 'viber://chat?number=+',
      text: 'viber',
    }
  }

  return items.value
}