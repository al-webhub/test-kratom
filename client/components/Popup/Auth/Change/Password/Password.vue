<script setup>
  import { useAuthStore } from '~/store/auth';
  import { useModalStore } from '~/store/modal';

  const { t } = useI18n({useScope: 'local'}) 

  const password = ref('')
  const password_confirmation = ref('')

  // COMPUTED
  const user = computed(() => {
    return useAuthStore().getUser
  })

  const errors = computed(() =>{
    return useAuthStore().getErrors
  })

  const rules = computed(() => { 
    return [
      {
        uid: 1,
        label: t('form.Min_8_characters'),
        validated: password.value.length >= 8
      },{
        uid: 2,
        label: t('form.1_Letter'),
        validated:  /[a-zA-Z]+/.test(password.value) 
      },{
        uid: 3,
        label: t('form.1_Number'),
        validated: /[0-9]+/.test(password.value)
      }
    ]
  })

  const isDisabled = computed(() => {
    return !password.value.length || !password_confirmation.value.length
  })

  // HANDLERS
  const backHandler = () => {
    useModalStore().open('logInPassword')
  }

  const closeHandler = () => {
    useModalStore().close('changePassword')
  }
</script>

<style src="./password.scss" lang="sass" scoped />

<template>
  <popup-layout-simple @close="closeHandler">
    <template v-slot:title>
      {{ $t('title.set_new_password') }}
    </template>
    <template v-slot:content>
      <div>
        <div class="popup__header">
          <p class="email" v-if="user">{{ t('for', {email: user.email}) }}</p>
          <ul class="popup-check__list">
            <li 
              v-for="rule in rules"
              :key="rule.id"
              :class="{active: rule.validated}"
              class="popup-check__item"
            >
              <span class="decor">
                <img src="~assets/svg-icons/check.svg" class="icon" />
              </span>
              <span class="text">{{ rule.label }}</span>
            </li>
          </ul>
        </div>

        <div class="popup__body">

          <form-password
            v-model="password"
            :placeholder="$t('form.New_Password')"
            :errors="errors.password"
            class="form-component"
          >
          </form-password>

          <form-password
            v-model="password_confirmation"
            :placeholder="$t('form.Password')"
            :errors="errors.password_confirmation"
            class="form-component"
          >
          </form-password>

          <button :class="{disabled: isDisabled}" class="main-button primary small">
              <span class="text">{{ $t('button.set_new_password') }}</span>
          </button>
        </div>
      </div>
    </template>
    <template v-slot:footer>
      <div class="footer">
        <button @click="backHandler" type="button" class="back-btn">{{ $t('button.Back') }}</button>
      </div>
    </template>
  </popup-layout-simple>
</template>

<i18n>
  {
    "en": {
      "for" : "for {email}",
    },
    "ru": {
      "for" : "для {email}",
    }
  }
</i18n>