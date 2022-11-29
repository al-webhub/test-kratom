<script>
export default {
  data() {
    return {
      currentTab: 'guest',
      errors: {
        firstname: {
          message: 'Error'
        },
        lastname: null,
        communication: null,
        communication_number: null,
        email: null,
        password: null,
      },
      new_user: {
        firstname: '',
        lastname: '',
        communication: null,
        communication_number: '',
      },
      login: null,
      password: null,
      communications: [
        'Viber',
        'Telegram'
      ]
    }
  },

  props: {
    user: {
      type: Object,
      default: false
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
        <p class="caption">{{ $t('text.information') }}</p>
      </div>

      <div class="checkout__item__body">
        <p class="checkout-caption checkout-caption-information">{{ $t('text.Register_for_quicker') }}</p>
        <p class="text">{{ $t('text.All_registered_users') }}</p>
      </div>

      <ul class="general-tabs__list">
        <li class="general-tabs__item" :class="{active: currentTab == 'guest'}" @click="currentTab = 'guest'" v-if="!user">{{ $t('text.Checkout_as_guest') }}</li>
        <li class="general-tabs__item" :class="{active: currentTab == 'login'}" @click="currentTab = 'login'">{{ $t('text.Log_In') }}</li>
        <li class="general-tabs__item" :class="{active: currentTab == 'register'}" @click="currentTab = 'register'" v-if="!user">{{ $t('text.Register_account') }}</li>
      </ul>

      <!-- GUEST TAB -->
      <div class="checkout_form__wrapper" v-if="currentTab == 'guest'">
        
        <form-text
          v-model="new_user.firstname"
          :placeholder="$t('text.First_name')"
          :error="errors.firstname"
          required
          class="form-component"
        >
        </form-text>

        <form-text
          v-model="new_user.lastname"
          :placeholder="$t('text.Last_name')"
          :error="errors.lastname"
          class="form-component"
        >
        </form-text>

        <form-select
          v-model="new_user.communication"
          :values="communications"
          :placeholder="$t('text.Preferred_communication')"
          :error="errors.communication"
          class="form-component"
        >
        </form-select>

        <form-text
          v-model="new_user.communication_number"
          :placeholder="$t('text.account')"
          :error="errors.communication_number"
          required
          :is-disabled="new_user.communication"
          class="form-component"
        >
        </form-text>

        <div class="chckout__item__shipping-info" style="margin-top:0">
          <p>{{ $t('text.your_telephone_number') }}</p>
        </div>
      </div>
      
      <!-- LOGIN TAB -->
      <div class="checkout_form__wrapper" v-else-if="currentTab == 'login'">
        <div v-if="user" class="checkout-user">
          <div class="checkout-user__container">
            <div :style="{backgroundImage: 'url(' + './img/photo-log-in.png' + ')'}" class="checkout-user__img"></div>
            <p class="checkout-user__name">{{ user.usermeta.firstname }}</p>
            <p class="checkout-user__active"><span class="icon-active"></span></p>
          </div>
          <button type="button" class="checkout-user__logout">
            <span class="text">{{ $t('text.logout') }}</span>
          </button>
        </div>

        <template v-else>

          <form-text
            v-model="login"
            placeholder="Email"
            :error="errors.email"
            required
            class="form-component"
          >
          </form-text>

          <form-password
            v-model="password"
            :placeholder="$t('text.Password')"
            :error="errors.password"
            required
            class="form-component"
          >
          </form-password>

          <button type="button" class="button-nav">{{ $t('text.Forgot_Password') }}</button>

          <button type="button" class="main-button-color">
            <span class="text">{{ $t('text.Log_In') }}</span>
          </button>

        </template>
      </div>
      
      <!-- REGISTER TAB -->
      <div class="checkout_form__wrapper" v-else-if="currentTab == 'register'">

        <form-text
          v-model="new_user.firstname"
          :placeholder="$t('text.First_name')"
          :error="errors.firstname"
          required
          class="form-component"
        >
        </form-text>

        <form-text
          v-model="new_user.lastname"
          :placeholder="$t('text.Last_name')"
          :error="errors.lastname"
          class="form-component"
        >
        </form-text>


        <form-text
          v-model="login"
          placeholder="Email"
          :error="errors.email"
          required
          class="form-component"
        >
        </form-text>

        <form-password
          v-model="password"
          :placeholder="$t('text.Password')"
          :error="errors.password"
          required
          class="form-component"
        >
        </form-password>

        <form-select
          v-model="new_user.communication"
          :values="communications"
          :placeholder="$t('text.Preferred_communication')"
          :error="errors.communication"
          class="form-component"
        >
        </form-select>

        <form-text
          v-model="new_user.communication_number"
          :placeholder="$t('text.account')"
          :error="errors.communication_number"
          required
          :is-disabled="new_user.communication"
          class="form-component"
        >
        </form-text>
          
        <button class="main-button-color">
          <span class="text">{{ $t('text.sign_up') }}</span>
        </button>

        <div class="popup__footer">
          <div class="popup__footer__sing-up">
            <p>{{ $t('text.Already_have_account') }}</p>
            <button type="button" class="button-enter js-button" data-target="log-in">{{ $t('text.Log_In') }}</button>
          </div>
        </div>

      </div>
  </li>
</template>