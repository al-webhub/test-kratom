<script>
export default {
  setup() {
    const { t } = useI18n({useScope: 'local'})
    return {t}
  },
  data() {
    return {
      communications: [
        "Telegram",
        "Whatsapp",
        "Skype",
        "Viber",
        "Facebook",
        "Instagram"
      ]
    }
  },

  props: {
    user: {
      type: Object
    },
    errors: {
      type: [Array, Boolean]
    }
  },

  computed: {
    accountPlaceholder() {
      const communication = this.user.communication || ''
      return communication + ' ' + this.$t('form.account')
    }
  }
}
</script>

<template>
  <form-select
    v-model="user.communication"
    :values="communications"
    :placeholder="$t('form.Preferred_communication')"
    required
    :error="errors?.communication"
    class="form-component"
  >
  </form-select>

  <form-text
    v-model="user.communication_number"
    :placeholder="accountPlaceholder"
    :error="errors?.communication_number"
    required
    :is-disabled="!user.communication"
    class="form-component"
  >
  </form-text>

  <div style="margin:25px 0 40px 0">
    <p style="font-size: 14px; line-height: 150%;">{{ t('Please_write_your') }}</p>
  </div>
</template>

<i18n>
  {
    "en": {
      "Please_write_your": "Please write your telephone number, your login, full link or another reference, corresponding to the connection way you prefer (which you have chosen above)",
    },
    "ru": {
      "Please_write_your": "Укажите свой номер телефона, логин, полную ссылку или другую ссылку, соответствующую предпочитаемому вами способу подключения (который вы выбрали выше)",
    }
  }
</i18n>
