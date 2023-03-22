<script setup>
  import { useAuthStore } from '~/store/auth';
  import { useModalStore } from '~/store/modal';

  const { t } = useI18n({useScope: 'local'}) 

  const isLoading = ref(false)
  const email = ref('')
  const throttleTimer = ref(0)
  const throttleTimerId = ref(null)

  // COMPUTED
  const user = computed(() => {
    return useAuthStore().getUser
  })

  const errors = computed(() =>{
    return useAuthStore().getErrors
  })

  const isDisabled = computed(() => {
    return throttleTimer.value > 0 || !email.value || email.value.length < 5
  })

  // METHODS
  const setThrottleTimeout = () => {
    throttleTimer.value = 30

    throttleTimerId.value = setInterval(function() {
      throttleTimer.value--

      if(throttleTimer.value <= 0)
        clearInterval(throttleTimerId.value)
    }, 1000)
  }

  // HANDLERS
  const backHandler = () => {
    useModalStore().open('logInPassword')
  }

  const closeHandler = () => {
    useModalStore().close('resetPassword')
  }

  const sendHandler = async () => {
  
    isLoading.value = true
    
    await useAuthStore().sendPasswordResetLink(email.value)
      .then((data) => {

        if(data.status === 200) {
          setThrottleTimeout()
          useNoty().setNoty(t('noty.send_reset_link_success', {email: email.value}))
        }

        if(data.status === 400) {
          useNoty().setNoty(data.message)
        }
      })
      .finally(() => {
        isLoading.value = false
      })
  }

  // HOOKS
  onMounted(() => {
    email.value = useModalStore().data('resetPassword')
  })
</script>

<style src="./reset.scss" lang="sass" scoped />

<template>
  <popup-layout-simple @close="closeHandler">
    <template v-slot:title>
      {{ $t('title.send_password_reset') }}
    </template>

    <template v-slot:content>
      <div>
        <p class="form-component">{{ $t('messages.reset_password') }}</p>
        <div class="popup__body">

          <form-text
            v-model="email"
            :placeholder="$t('form.email')"
            :errors="errors.email"
            class="form-component"
          >
          </form-text>

          <transition name="fade-in">
            <p
              v-if="throttleTimer"
              class="form-component"
              v-html="$t('messages.check_email', {email: email, sec: throttleTimer})"
            >
            </p>
          </transition>

          <button
            @click="sendHandler"
            :class="{loading: isLoading, disabled: isDisabled}"
            clickable
            class="main-button primary small"
          >
            <span class="text">{{ $t('button.get_reset_link') }}</span>
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