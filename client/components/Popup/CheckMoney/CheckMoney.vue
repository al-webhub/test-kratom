<script>
export default {
  data() {
    return {
      isActive: false
    }
  },

  methods: {
    closeHandler() {
      this.isActive = false
    }
  }
}
</script>

<style src="./check-money.scss" lang="sass" scoped />

<template>
<popup-layout-simple :is-active="isActive" @close="closeHandler">
    <template v-slot:title>
      <div class="popup-check-email__icon">
            <span class="icon-referral"></span>
        </div>
    </template>
    <template v-slot:content>
      {{ 'text.Text_money' }} 😊
    </template>
  </popup-layout-simple>
</template>