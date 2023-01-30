<script>
import {useAppStore} from '~/store/app'

export default {
  setup() {
    const { t, locale } = useI18n({useScope: 'local'})
    const appStore = useAppStore()

    const payments = computed(() => {
      return appStore.payments(locale.value)
    })

    return {
      t,
      payments
    }
  },

  data() {
    return {}
  },

  computed: {
    contacts() {
      const contacts = useContacts()

      return [
        contacts.address,
        contacts.email,
        contacts.phone,
      ]
    },

    navs() {
      const menu = useMenu().menu

      const groups = useProductGroups()
      const productGroups = groups.reduce((carry, item) => carry.concat(item.items), [])

      return [
        {
          name: this.t('products'),
          items: productGroups
        },{
          name: this.t('info'),
          items: menu
        }
        
      ]
    },

    year() {
      return new Date().getFullYear()
    }
  },
}
</script>

<style src="./footer.scss" lang="sass" scoped />

<template>
  <footer class="footer">


    <!-- BODY -->
    <div class="body">
        
      <img src="~assets/images/logo.svg" alt="Kratom" class="logo">

      <nav
        v-for="nav in navs"
        :key="nav.name"
        class="nav"
      >
        <div class="footer-title">{{ nav.name}}</div>
        <ul class="nav-list">
          <li
            v-for="(item, index) in nav.items"
            :key="item.id"
            class="nav-item"
          >
            <NuxtLink
              :to="localePath(item.link)"
              class="nav-link"
            >
              {{ item.name }}
            </NuxtLink>
          </li>
        </ul>
      </nav>

      <div class="cp">
        <div class="contacts">
          <div class="footer-title">{{ t('contact_us') }}</div>
          <div v-for="(contact, index) in contacts" :key="index" class="contacts-item">
            <img :src="contact.icon" class="icon" />
            <a :href="contact.link" class="contacts-link">{{ contact.text }}</a>
          </div>
        </div>
        <div class="payment">
          <div class="footer-title">{{ t('payment_options') }}</div>
          <div class="payment-images">
            <template
                v-for="(payment, index) in payments"
                :key="index"
            >
              <nuxt-img
                :src="payment.image"
                :alt="payment.name"
                :title="payment.name"
                width="65"
                height="35"
                sizes = "mobile:80px"
                format = "webp"
                quality = "100"
                loading = "lazy"
                class="payment-image">
              </nuxt-img>
            </template>
          </div>
        </div>
      </div>
        
    </div>

    <!-- SUB -->
    <div class="sub">
      <p class="sub-copyright">
        Copyright © {{ year }}
      </p>

      <NuxtLink :to="localePath('terms')" class="sub-link">
        {{ $t('title.Terms_Conditions') }}
      </NuxtLink>

      <NuxtLink :to="localePath('privacy')" class="sub-link">
        {{ $t('title.Privacy_Policy') }}
      </NuxtLink>
    </div>

  </footer>
</template>

<i18n>
  {
    en: {
      contact_us: "Contact us",
      payment_options: "Payment options",
      products: "Products",
      info: "Info"
    },

    ru: {
      contact_us: "Свяжитесь с нами",
      payment_options: "Варианты оплаты",
      products: "Товары",
      info: "Информация"
    }
  }
</i18n>