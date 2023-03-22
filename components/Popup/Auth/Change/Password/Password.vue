<script setup>
  import { useAuthStore } from '~/store/auth';
  import { useModalStore } from '~/store/modal';

  const route = useRoute()
  const { t } = useI18n({useScope: 'local'}) 

  const isLoading = ref(false)
  const errors = ref([])

  const changeForm = ref({
    email: '',
    token: '',
    password: '',
    password_confirmation: ''
  })


  // COMPUTED
  const rules = computed(() => { 
    return [
      {
        uid: 1,
        label: t('form.Min_8_characters'),
        validated: changeForm.value.password.length >= 8
      },{
        uid: 2,
        label: t('form.1_Letter'),
        validated:  /[a-zA-Z]+/.test(changeForm.value.password) 
      },{
        uid: 3,
        label: t('form.1_Number'),
        validated: /[0-9]+/.test(changeForm.value.password)
      }
    ]
  })

  const isDisabled = computed(() => {
    return !changeForm.value.password.length || !changeForm.value.password_confirmation.length
  })

  // HANDLERS
  const backHandler = () => {
    useModalStore().open('logInPassword')
  }

  const closeHandler = () => {
    navigateTo('/')
    useModalStore().close('changePassword')
  }

  const changeHandler = async () => {

    changeForm.value.email = route.query?.email
    changeForm.value.token = route.query?.t

    isLoading.value = true
    await useAuthStore().changePassword(changeForm.value)
      .then((data) => {
        console.log('change result', data)
        if(data.status === 200){
          useNoty().setNoty(t('noty.password_changed_success'), 5000)
          closeHandler()
        }

        if(data.status === 400){
          useNoty().setNoty(data.message)
        }
      })
      .catch((e) => {
        errors.value = e.errors
        useNoty().setNoty(e.message)
        //console.log('e', e)
      })
      .finally(() => {
        isLoading.value = false
      })
  }

  onMounted(() => {
    if(!route.query?.newpassword || !route.query?.email || !route.query?.t) {
      closeHandler()
    }else{
      changeForm.value.email = route.query?.email
      changeForm.value.token = route.query?.t
    }
  })

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
            v-model="changeForm.password"
            :placeholder="$t('form.New_Password')"
            :error="errors.password"
            class="form-component"
          >
          </form-password>

          <form-password
            v-model="changeForm.password_confirmation"
            :placeholder="$t('form.Password')"
            :error="errors.password_confirmation"
            class="form-component"
          >
          </form-password>

          <button
            @click="changeHandler"
            :class="{disabled: isDisabled}"
            clickable
            class="main-button primary small"
          >
            <span class="text">{{ $t('button.set_new_password') }}</span>
          </button>
        </div>
      </div>
    </template>
    <template v-slot:footer>
      <div class="footer">
        <button @click="backHandler" clickable type="button" class="back-btn">{{ $t('button.Back') }}</button>
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