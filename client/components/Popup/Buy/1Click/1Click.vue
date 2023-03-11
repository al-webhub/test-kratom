<script setup>
    import { useFeedbackStore } from '~/store/feedback'
    import { useModalStore } from '~/store/modal';

    const { t } = useI18n({useScope: 'local'})

    const isLoading = ref(false)
    const order = ref({
      name: null,
      phone: null,
      text: null
    })

    // COMPUTED
    const product = computed(() => {
      return useModalStore().data('buy1')
    })

    const errors = computed(() => {
      return useFeedbackStore().errors
    })

    // HANDLERS
    const closeHandler = () => {
      useModalStore().close('buy1')
    }

    const createHandler = async () => {
      isLoading.value = true

      try {
        await useFeedbackStore().createFeedback({
          ...order.value,
          extras: {
            product: product.value
          }
        }).then((res) => {
          useNoty().setNoty(t('noty.1click_success'))
          closeHandler()
          order.value.name = null
          order.value.phone = null
          order.value.text = null
        })
      }catch(e) {
        useNoty().setNoty(t('noty.1click_fail'))
      }finally {
        isLoading.value = false
      }   
    }
</script>

<style src="./1-click.scss" lang="sass" scoped />

<template>
  <popup-layout-simple @close="closeHandler">
    <template v-slot:title>
      {{ t('buy-1-click') }}
    </template>

    <template v-slot:content>
      <div>
        <p class="form-item">{{ t('leave_your_contacts') }}</p>

        <form-text
          v-model="order.name"
          :placeholder="$t('form.first_name')"
          :error="errors?.name"
          class="form-item"
        >
        </form-text>

        <form-text
          v-model="order.phone"
          :placeholder="$t('form.phone')"
          :error="errors?.phone"
          class="form-item"
        >
        </form-text>

        <form-textarea
          v-model="order.text"
          :placeholder="$t('form.your_comment')"
          :error="errors?.text"
          class="form-item"
        >
        </form-textarea>
      </div>
    </template>

    <template v-slot:footer>
      <button @click="createHandler()" :class="{loading: isLoading}" clickable class="main-button primary small btn">
        <span class="text">{{ $t('button.post') }}</span>
      </button>
    </template>

  </popup-layout-simple>
</template>

<i18n>
  {
    en: {
      "buy-1-click": "buy now with 1-click",
      "leave_your_contacts": "Leave your contacts and we will contact you shortly"
    },

    ru: {
      "buy-1-click": "Купить в 1 клик",
      "leave_your_contacts": "Оставьте свои контакты, и мы свяжемся с вами в ближайшее время"
    }
  }
</i18n>