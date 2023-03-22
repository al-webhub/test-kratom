import pinIcon from '/assets/svg-icons/pin.svg';
import phoneIcon from '/assets/svg-icons/phone.svg';
import mailIcon from '/assets/svg-icons/mail.svg';
import telegramIcon from '/assets/svg-icons/telegram.svg';
import whatsappIcon from '/assets/svg-icons/whatsapp.svg';
import skypeIcon from '/assets/svg-icons/skype.svg';
import viberIcon from '/assets/svg-icons/viber.svg';

export const useContacts = () => {
  const { t } = useI18n({useScope: 'global'})
  const { isMobile } = useDevice()

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
      link: 'tg://resolve?domain=kratomhelper',
      text: 'telegram',
    },
    whatsapp: {
      icon: whatsappIcon,
      link: 'https://wa.me/420722133136',
      text: 'whatsapp',
    },
    skype: {
      icon: skypeIcon,
      link: 'skype:live:.cid.408ed7c5750344f9?chat',
      text: 'skype',
    },
    viber: {
      icon: viberIcon,
      link: isMobile? 'viber://chat?number=+420722133136': 'viber://chat?number=420722133136',
      text: 'viber',
    }
  }

  return contacts
}