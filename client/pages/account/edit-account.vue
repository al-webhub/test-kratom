<script>
definePageMeta({
  layout: "account",
});

export default {
  data(){
    return {
      user: {
        usermeta: {
          firstname: '',
          lastname: '',
          email: '',
          telephone: '',
          preferred_communication: '',
          communication_number: ''
        }
      }
    }
  },
}
</script>

<style src="assets/scss/pages/account/edit-account.scss" lang="sass" scoped />

<template>
  <div class="profile__address">
    <div class="profile__form__body">
      
      <form-text
        v-model="user.firstname"
        :placeholder="$t('text.First_name')"
        class="form-component"
      >
      </form-text>

      <form-text
        v-model="user.lastname"
        :placeholder="$t('text.Last_name')"
        class="form-component"
      >
      </form-text>

      <form-text
        v-model="user.email"
        placeholder="Email"
        required
        class="form-component"
      >
      </form-text>

      <form-text
        v-model="user.telephone"
        :placeholder="$t('text.International_phone')"
        required
        class="form-component"
      >
      </form-text>

      <form-select
        v-model="user.preferred_communication"
        :placeholder="$t('text.Preferred_communication')"
        :values="['Viber', 'Telegram']"
        class="form-component"
      >
      </form-select>

      <form-text
        v-model="user.communication_number"
        :placeholder="$t('text.account')"
        required
        class="form-component"
      >
      </form-text>


      <!-- <label class="input__wrapper js-input-wrapper">
          <input type="text" class="main-input js-input" name="firstname" required="" value="{{ $user->usermeta->firstname }}">
          <span class="custome-placeholder__wrapper">
              <span class="custome-placeholder__before"></span>
              <span class="custome-placeholder__text">
                  <span class="inner-text">{{ $t('text.First_name') }}</span>
              </span>
              <span class="custome-placeholder__after"></span>
          </span>
      </label>
      <label class="input__wrapper js-input-wrapper">
          <input name="lastname" type="text" class="main-input js-input" value="{{ $user->usermeta->lastname }}">
          <span class="custome-placeholder__wrapper">
              <span class="custome-placeholder__before"></span>
              <span class="custome-placeholder__text">
                  <span class="inner-text">{{ $t('text.Last_name') }}</span>
              </span>
              <span class="custome-placeholder__after"></span>
          </span>
      </label>
      <label class="input__wrapper js-input-wrapper">
          <input type="email" name="email" value="{{ $user->email }}" class="main-input js-input" required="" >
          <span class="custome-placeholder__wrapper">
              <span class="custome-placeholder__before"></span>
              <span class="custome-placeholder__text">
                  <span class="inner-text">Email <span>*</span></span>
              </span>
              <span class="custome-placeholder__after"></span>
          </span>
      </label>
      <label class="input__wrapper js-input-wrapper">
          <input type="tel" class="main-input js-input" name="telephone" value="{{ $user->usermeta->telephone }}">
          <span class="custome-placeholder__wrapper">
              <span class="custome-placeholder__before"></span>
              <span class="custome-placeholder__text">
                  <span class="inner-text">{{ $t('text.International_phone') }}</span>
              </span>
              <span class="custome-placeholder__after"></span>
          </span>
      </label>
      <div class="input__wrapper js-input-wrapper js-drop-item general-drop">
          <input type="text" class="main-input js-input js-drop-input js-drop-button" readonly="" required="" name="extras[communication]" v-model="selectedCommunication"> 
          <span class="custome-placeholder__wrapper">
              <span class="custome-placeholder__before"></span>
              <span class="custome-placeholder__text">
                  <span class="inner-text">{{ $t('text.Preferred_communication') }}<span>*</span></span>
              </span>
              <span class="custome-placeholder__after"></span>
          </span>
          <span class="icon-drop"></span>
          <div class="general-drop__list">
              <div class="general-drop__item general-drop__item-select">
                  <div class="text">{{ $t('text.Please_select') }}</div>
              </div>
              <div class="general-drop__item js-drop-contains" v-for="(communication, key) in communications" @click="selectedCommunication = communication" >
                  <span class="icon-active"></span>
                  <div class="text" >@{{ communication }}</div>
              </div>
          </div>
      </div>
      
      <label class="input__wrapper js-input-wrapper" :class="{disabled: !selectedCommunication}">
          <input type="text" class="main-input js-input" required="" name="extras[communication_number]" value="{{ $user->usermeta->extras['communication_number'] ?? '' }}">
          <span class="custome-placeholder__wrapper">
              <span class="custome-placeholder__before"></span>
              <span class="custome-placeholder__text">
                  <span class="inner-text">@{{ selectedCommunication }} {{ $t('text.account') }} <span>*</span></span>
              </span>
              <span class="custome-placeholder__after"></span>
          </span>
      </label> -->
      
      <div style="margin:0 0 30px 0">
          <p style="font-size: 14px; line-height: 150%;">{{ $t('text.Please_write_your') }}</p>
      </div>
  </div>
  <div class="profile__form__footer">
      <button type="button" class="button-only-text js-button" data-target="change-pass">
          <span class="text">{{ $t('text.Change_password') }}</span>
      </button>
      <button class="main-button main-button-small main-button-profile">
          <span class="text">{{ $t('text.save_address') }}</span>
      </button>
  </div>
  </div>
</template>