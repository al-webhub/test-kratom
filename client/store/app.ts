type Popups = "adult"
type Langs = "en" | "ru"

export const useAppStore = defineStore('appStore', {
  persist: true,

  state: () => ({ 
    
    popups: {
      adult: true
    },

    data: {
      payments: {
        en: {
          visa: {
            name: "Visa",
            image: "/images/payment/visa.png"
          },
          mastercard: {
            name: "Mastercard",
            image: "/images/payment/mastercard.png"
          },
          paypal: {
            name: "Paypal",
            image: "/images/payment/paypal.png"
          },
          bitcoin: {
            name: "Bitcoin",
            image: "/images/payment/bitcoin.png"
          },
          wu: {
            name: "Western Union",
            image: "/images/payment/wu.png"
          },
          qiwi: {
            name: "Qiwi",
            image: "/images/payment/qiwi.png"
          }
        },
        ru: {
          sber: {
            name: "Sber",
            image: "/images/payment/sber.png"
          },
          tinkoff: {
            name: "Tinkoff",
            image: "/images/payment/tinkoff.png"
          },
          qiwi: {
            name: "Qiwi",
            image: "/images/payment/qiwi.png"
          },
          bitcoin: {
            name: "Любая криптовалюта",
            image: "/images/payment/bitcoin.png"
          },
          visa: {
            name: "Visa",
            image: "/images/payment/visa.png"
          },
          mastercard: {
            name: "Mastercard",
            image: "/images/payment/mastercard.png"
          },
          paypal: {
            name: "Paypal",
            image: "/images/payment/paypal.png"
          },
          wu: {
            name: "Western Union",
            image: "/images/payment/wu.png"
          }
        }
      },

      deliveryTimes: {
        en: [
          "3 to 28 days (anywhere in the world)",
          "2 to 12 days (Europe)",
          "1-2 days (Czech Republic)"
        ],
        ru: [
          "1-2 дня (Чехия)",
          "от 2х до 12 дней (Европа)",
          "от 3 до 28 дней (в любую точку СНГ, ближний и дальний восток, даем гарантию на успешное получение)"
        ]
      },

      deliveryMethods: {
        en: [
          "Ups",
          "Dhl",
          "Fedex",
          "Ems",
          "Tnt",
          "Česká pošta"
        ],
        ru: [
          "Česká pošta",
          "Tnt",
          "Ems",
          "Fedex",
          "KazPost",
          "Почта России",
          "Dhl",
          "Ups"
        ]
      }
    }
  }),
  
  getters: {
    adult: (state) => state.popups.adult,

    payments: (state) => { 
      return (lang: Langs = 'en') => state.data.payments[lang]
    },

    deliveryTimes: (state) => { 
      return (lang: Langs = 'en') => state.data.deliveryTimes[lang]
    },
    
    deliveryMethods: (state) => { 
      return (lang: Langs = 'en') => state.data.deliveryMethods[lang]
    }
  },

  actions: {
    close(name: Popups) {
      this.popups[name] = false
    },

    open(name: Popups) {
      this.popups[name] = false
    },

    toggle(name: Popups) {
      this.popups[name] = !this.popups[name]
    }
  },
})