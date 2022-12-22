<script>
export default {
  data() {
    return {
      tabs: ['guest', 'login', 'register'],
      currentTab: 0,
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
    },
    order: {
      type: Object
    }
  },
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

      <simple-tabs
        v-model:activeTab="currentTab"
        :values="tabs"
        class="general-tabs__list"
      >
      </simple-tabs>


      <!-- GUEST TAB -->
      <div class="checkout_form__wrapper" v-if="currentTab === 0">
        
        <form-text
          v-model="order.user.firstname"
          :placeholder="$t('text.First_name')"
          :error="errors.firstname"
          required
          class="form-component"
        >
        </form-text>

        <form-text
          v-model="order.user.lastname"
          :placeholder="$t('text.Last_name')"
          :error="errors.lastname"
          class="form-component"
        >
        </form-text>

        <form-select
          v-model="order.user.communication"
          :values="communications"
          :placeholder="$t('text.Preferred_communication')"
          :error="errors.communication"
          class="form-component"
        >
        </form-select>

        <form-text
          v-model="order.user.communication_number"
          :placeholder="$t('text.account')"
          :error="errors.communication_number"
          required
          :is-disabled="!order.user.communication"
          class="form-component"
        >
        </form-text>

        <div class="chckout__item__shipping-info" style="margin-top:0">
          <p>{{ $t('text.your_telephone_number') }}</p>
        </div>
      </div>
      
      <!-- LOGIN TAB -->
      <div class="checkout_form__wrapper" v-else-if="currentTab === 1">
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
            v-model="order.user.email"
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
      <div class="checkout_form__wrapper" v-else-if="currentTab === 2">

        <form-text
          v-model="order.user.firstname"
          :placeholder="$t('text.First_name')"
          :error="errors.firstname"
          required
          class="form-component"
        >
        </form-text>

        <form-text
          v-model="order.user.lastname"
          :placeholder="$t('text.Last_name')"
          :error="errors.lastname"
          class="form-component"
        >
        </form-text>


        <form-text
          v-model="order.user.email"
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
          v-model="order.user.communication"
          :values="communications"
          :placeholder="$t('text.Preferred_communication')"
          :error="errors.communication"
          class="form-component"
        >
        </form-select>

        <form-text
          v-model="order.user.communication_number"
          :placeholder="$t('text.account')"
          :error="errors.communication_number"
          required
          :is-disabled="order.user.communication"
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