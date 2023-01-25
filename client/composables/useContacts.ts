import pinIcon from '/assets/svg-icons/pin.svg';
import phoneIcon from '/assets/svg-icons/phone.svg';
import mailIcon from '/assets/svg-icons/mail.svg';
import telegramIcon from '/assets/svg-icons/telegram.svg';
import whatsappIcon from '/assets/svg-icons/whatsapp.svg';
import skypeIcon from '/assets/svg-icons/skype.svg';
import viberIcon from '/assets/svg-icons/viber.svg';

export const useContacts = () => {
  const { t } = useI18n({useScope: 'global'})

  const contacts = {
    address: {
      link: '/',
      icon: pinIcon,
      text: t('contacts.address')
    },
    email: {
      icon: mailIcon,
      link: `mailto:${t('contacts.email')}`,
      text: t('contacts.email')
    },
    phone: {
      icon: phoneIcon,
      link: `tel:${t('contacts.phone')}`,
      text: t('contacts.phone')
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

  return contacts
}