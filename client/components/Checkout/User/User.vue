<script>
import { useAuthStore } from '~/store/auth';

export default {
  setup() {
    const { t } = useI18n({useScope: 'local'}) 
    const authStore = useAuthStore()

    return {
      authStore,
      t
    }
  },

  data() {
    return {
      currentTab: 0,
      isLoading: false,
      login: null,
      password: null,
    }
  },

  props: {
    order: {
      type: Object
    },
  },

  computed: {
    tabs() {
      if(this.isAuth)
        return [
          this.t('login'),
        ]
      else
        return [
          this.t('checkout_as_guest'),
          this.t('login'),
          this.t('register_account'),
        ]
    },

    isAuth() {
      return this.authStore.isAuth
    },

    user() {
      return this.authStore?.getUser
    },

    errors() {
      return this.authStore.getErrors
    }
  },

  methods: {
    async loginHandler() {
      this.isLoading = true
      useLogin()().finally(() => {
        this.isLoading = false
      })
    },

    async registerHandler() {
      this.isLoading = true
      useRegister()().finally(() => {
        this.isLoading = false
      })
    },

    async logoutHandler() {
      this.isLoading = true
      useLogout()().finally(() => {
        this.isLoading = false
      })
    },

    loginLinkHandler() {
      this.currentTab = 1
    }
  }
}
</script>

<style src="./../checkout.scss" lang="sass" scoped />
<style src="./user.scss" lang="sass" scoped />

<template>
  <li class="checkout__item active">
      <div class="checkout__item__noty">
        <p>{{ $t('text.Please_complete') }}</p>
      </div>

      <div class="checkout__item__header">
        <p class="calc">1/3</p>
        <p class="caption">{{ t('information') }}</p>
      </div>

      <div class="checkout__item__body">
        <p class="checkout-caption checkout-caption-information">{{ t('Register_for_quicker') }}</p>
        <p class="text">{{ t('All_registered_users') }}</p>
      </div>

      <simple-tabs
        v-model:modelValue="currentTab"
        :values="tabs"
        class="user-tabs"
      >
      </simple-tabs>


      <!-- GUEST TAB -->
      <div class="checkout_form__wrapper" v-if="currentTab === 0 && !isAuth">
        
        <form-text
          v-model="order.user.firstname"
          :placeholder="$t('form.first_name')"
          :error="errors?.user?.firstname"
          required
          class="form-component"
        >
        </form-text>

        <form-text
          v-model="order.user.lastname"
          :placeholder="$t('form.Last_name')"
          :error="errors?.user?.lastname"
          class="form-component"
        >
        </form-text>

        <form-p-c
          :user="order.user"
          :errors="errors"
        ></form-p-c>
      </div>
      
      <!-- LOGIN TAB -->
      <div class="checkout_form__wrapper" v-else-if="currentTab === 1 || isAuth">
        
        <template v-if="isAuth">
          <div class="checkout-user">
            
            <div class="checkout-user__container">
              <div :style="{backgroundImage: 'url(' + user.photo + ')'}" class="checkout-user__img"></div>
              <p class="checkout-user__name">{{ user.fullname }}</p>
              <p class="checkout-user__active">
                <img src="~assets/svg-icons/check.svg" class="icon icon-active" />
              </p>
            </div>

            <button @click="logoutHandler" clickable type="button" class="checkout-user__logout">
              <span class="text">{{ $t('button.logout') }}</span>
            </button>

          </div>
        </template>

        <template v-else>

          <form-text
            v-model="user.email"
            placeholder="Email"
            :error="errors?.user?.email"
            required
            class="form-component"
          >
          </form-text>

          <form-password
            v-model="user.password"
            :placeholder="$t('form.Password')"
            :error="errors?.user?.password"
            required
            class="form-component"
          >
          </form-password>

          <div class="forgot__wrapper">
            <button clickable class="forgot-btn">{{ $t('button.Forgot_Password') }}</button>
          </div>

          <button @click="loginHandler" :class="{loading: isLoading}" clickable class="main-button primary">
            <span class="text">{{ $t('button.Log_In') }}</span>
          </button>

        </template>
      </div>
      
      <!-- REGISTER TAB -->
      <div class="checkout_form__wrapper" v-else-if="currentTab === 2 && !isAuth">

        <form-text
          v-model="user.firstname"
          :placeholder="$t('form.first_name')"
          :error="errors?.firstname"
          required
          class="form-component"
        >
        </form-text>

        <form-text
          v-model="user.lastname"
          :placeholder="$t('form.Last_name')"
          :error="errors?.lastname"
          class="form-component"
        >
        </form-text>

        <form-text
          v-model="user.email"
          placeholder="Email"
          :error="errors?.email"
          required
          class="form-component"
        >
        </form-text>

        <form-password
          v-model="user.password"
          :placeholder="$t('form.Password')"
          :error="errors?.password"
          required
          class="form-component"
        >
        </form-password>

        <form-password
          v-model="user.password_confirmation"
          :placeholder="$t('form.Confirm_Password')"
          :error="errors?.password_confirmation"
          required
          class="form-component"
        >
        </form-password>

        <form-p-c
          :user="user"
          :errors="errors"
        ></form-p-c>
          
        <button @click="registerHandler" :class="{loading: isLoading}" clickable class="main-button primary">
          <span class="text">{{ $t('button.sign_up') }}</span>
        </button>

        <div class="already__wrapper">
          <p>{{ t('Already_have_account') }}</p>
          <button
            @click="loginLinkHandler"
            clickable
            class="button-enter a-link"
          >
            {{ $t('button.Log_In') }}
          </button>
        </div>

      </div>
  </li>
</template>

<i18n>
  {
    "en": {
      "checkout_as_guest": "Checkout as guest", 
      "login": "Login",
      "register_account": "Register account",
      "Already_have_account": "Already have account?",
      "information" : "information",
      "Register_for_quicker" : "Register for quicker orders and get a bonus",
      "All_registered_users" : "All registered users get the compensation for their orders. The compensation is equal to 1% of the order amount. It is saved in your personal cabinet and may be spent on any goods in our e-shop at any time;",
    },
    "ru": {
      "checkout_as_guest": "Как гость", 
      "login": "Войти",
      "register_account": "Зарегистрироваться",
      "Already_have_account": "Уже есть аккаунт?",
      "information" : "информация",
      "Register_for_quicker" : "Зарегистрируйтесь, чтобы делать заказы быстрее и получать бонусы",
      "All_registered_users" : "Все зарегистрированные пользователи получают вознаграждение за свои заказы. Компенсация составляет 1% от суммы заказа. Он сохраняется в вашем личном кабинете и может быть потрачен на любые товары в нашем интернет-магазине в любое время;",
    }
  }
</i18n>