<script>
export default {
  data() {
    return {
      isActive: false,
      new_user: {
        firstname: '',
        lastname: '',
        email: '',
        password: '',
        password_confirmation: '',
        communication: null,
        communication_number: '',
      },
      errors: {
        firstname: {
          message: 'Error'
        },
        lastname: null,
        communication: null,
        communication_number: null,
        email: null,
        password: null,
        password_confirmation: null
      }
    }
  },

  methods: {
    closeHandler() {
      this.isActive = false
    }
  }
}
</script>

<style src="./email.scss" lang="sass" scoped />

<template>

<popup-layout-simple :is-active="isActive" @close="closeHandler">
    <template v-slot:title>
      {{ $t('text.Sign_Up') }}
    </template>
    <template v-slot:content>
      <div class="popup__body">
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
          v-model="new_user.email"
          placeholder="Email"
          :error="errors.email"
          required
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

        <div style="margin:30px 0">
          <p style="font-size: 14px; line-height: 150%;">{{ $t('text.Please_write_your') }}</p>
        </div>

        <form-password
          v-model="new_user.password"
          :placeholder="$t('text.Password')"
          :error="errors.password"
          required
          class="form-component"
        >
        </form-password>

        <form-password
          v-model="new_user.password_confirmation"
          :placeholder="$t('text.Confirm_Password')"
          :error="errors.password_confirmation"
          required
          class="form-component"
        >
        </form-password>

        <div class="checkout__item__policy">
          <label class="input__wrapper input__wrapper-checkbox">
            <input type="checkbox" value="1" required="required" class="input-checkbox"> 
            <span class="custome-checkbox"><span class="icon-active"></span></span> 
            <span>{{ $t('text.I_agreed_with') }} <a href="/privacy" target="_blade">{{ $t('text.Privacy_Policy') }}</a></span>
          </label>
        </div>
            
        <!-- //Добавил пароль, в макете его небыло -->
        <button class="main-button-color main-button-color-popup">
            <span class="text">{{ $t('text.Sign_Up') }}</span>
        </button>
        <div class="popup__footer">
            <div class="popup__footer__sing-up">
                <p>{{ $t('text.Already_have_account') }}</p>
                <button type="button" class="button-enter">{{ $t('text.Log_In') }}</button>
            </div>
        </div>

      </div>
    </template>
    <template v-slot:footer>

    </template>
  </popup-layout-simple>


    <!-- <input type="hidden" name="referrer_id" value="{{ $ref_id }}"> -->
    <!-- <section class="popup popup-registration" data-target="registration">
        <button type="button" class="close__popup js-close">
            <span class="icon-close"></span>
        </button>
        <p class="popup-caption">{{ $t('text.Sign_Up') }}</p>
        <div class="popup__body">
            <label class="input__wrapper js-input-wrapper @error('name') error @enderror">
                <input type="text" class="main-input js-input" name="name" value="{{ old('name') }}" require>
                <span class="custome-placeholder__wrapper">
                    <span class="custome-placeholder__before"></span>
                    <span class="custome-placeholder__text">
                        <span class="inner-text">{{ $t('text.First_name') }}<span>*</span></span>
                    </span>
                    <span class="custome-placeholder__after"></span>
                </span>
                @error('name')
                    <span class="input-error-text">{{ $message }}</span>
                @enderror
            </label>
            <label class="input__wrapper js-input-wrapper @error('lastname') error @enderror">
                <input type="text" class="main-input js-input" name="lastname" value="{{ old('lastname') }}">
                <span class="custome-placeholder__wrapper">
                    <span class="custome-placeholder__before"></span>
                    <span class="custome-placeholder__text">
                        <span class="inner-text">{{ $t('text.Last_name') }}</span>
                    </span>
                    <span class="custome-placeholder__after"></span>
                </span>
                @error('lastname')
                    <span class="input-error-text">{{ $message }}</span>
                @enderror
            </label>
            <label class="input__wrapper js-input-wrapper @error('email') error @enderror">
                <input type="email" class="main-input js-input" value="{{ old('email') }}" name="email">
                <span class="custome-placeholder__wrapper">
                    <span class="custome-placeholder__before"></span>
                    <span class="custome-placeholder__text">
                        <span class="inner-text">{{ $t('text.Email') }} <span>*</span></span>
                    </span>
                    <span class="custome-placeholder__after"></span>
                </span>
                @error('email')
                    <span class="input-error-text">{{ $message }}</span>
                @enderror
            </label>
            <div class="input__wrapper js-input-wrapper js-drop-item general-drop">
                <input type="text" name="extras[communication]" class="main-input js-input js-drop-input js-drop-button" readonly require> 
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
                    <div class="general-drop__item js-drop-contains">
                        <span class="icon-active"></span>
                        <div class="text">Viber</div>
                    </div>
                    <div class="general-drop__item js-drop-contains">
                        <span class="icon-active"></span>
                        <div class="text">WhatsApp</div>
                    </div>
                    <div class="general-drop__item js-drop-contains">
                        <span class="icon-active"></span>
                        <div class="text">Skype</div>
                    </div>
                    <div class="general-drop__item js-drop-contains">
                        <span class="icon-active"></span>
                        <div class="text">Telegram</div>
                    </div>
                    <div class="general-drop__item js-drop-contains">
                        <span class="icon-active"></span>
                        <div class="text">Facebook</div>
                    </div>
                    <div class="general-drop__item js-drop-contains">
                        <span class="icon-active"></span>
                        <div class="text">Instagram</div>
                    </div>
                </div>
            </div>
            <label class="input__wrapper js-input-wrapper">
                <input type="text" class="main-input js-input" name="extras[communication_number]">
                <span class="custome-placeholder__wrapper">
                    <span class="custome-placeholder__before"></span>
                    <span class="custome-placeholder__text">
                        <span class="inner-text">{{ $t('text.Account/full_number/link') }}<span>*</span></span>
                    </span>
                    <span class="custome-placeholder__after"></span>
                </span>
            </label>
            <div style="margin:30px 0">
                <p style="font-size: 14px; line-height: 150%;">{{ $t('text.Please_write_your') }}</p>
            </div>
            
            <label class="input__wrapper js-input-wrapper @error('password') error @enderror">
                <input type="password" name="password" class="main-input js-input">
                <span class="custome-placeholder__wrapper">
                    <span class="custome-placeholder__before"></span>
                    <span class="custome-placeholder__text">
                        <span class="inner-text">{{ $t('text.Password') }} <span>*</span></span>
                    </span>
                    <span class="custome-placeholder__after"></span>
                </span>
                @error('password')
                    <span class="input-error-text">{{ $message }}</span>
                @enderror
            </label>
            <label class="input__wrapper js-input-wrapper">
                <input type="password" name="password_confirmation" class="main-input js-input">
                <span class="custome-placeholder__wrapper">
                    <span class="custome-placeholder__before"></span>
                    <span class="custome-placeholder__text">
                        <span class="inner-text">{{ $t('text.Confirm_Password') }} <span>*</span></span>
                    </span>
                    <span class="custome-placeholder__after"></span>
                </span>
            </label>
            <div class="checkout__item__policy">
	            <label class="input__wrapper input__wrapper-checkbox">
	            	<input type="checkbox" value="1" required="required" class="input-checkbox"> 
	            	<span class="custome-checkbox"><span class="icon-active"></span></span> 
	            	<span>{{ $t('text.I_agreed_with') }} <a href="{{ url('/privacy') }}" target="_blade">{{ $t('text.Privacy_Policy') }}</a></span>
	            </label>
	        </div>
            
            
            <button class="main-button-color main-button-color-popup">
                <span class="text">{{ $t('text.Sign_Up') }}</span>
            </button>
            <div class="popup__footer">
                <div class="popup__footer__sing-up">
                    <p>{{ $t('text.Already_have_account') }}</p>
                    <button type="button" class="button-enter js-button" data-target="registration-social">{{ $t('text.Log_In') }}</button>
                </div>
            </div>
        </div>
    </section> -->
</template>