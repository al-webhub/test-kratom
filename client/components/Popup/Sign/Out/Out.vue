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

<style src="./out.scss" lang="sass" scoped />

<template>
  <popup-layout-simple :is-active="isActive" @close="closeHandler">
    <template v-slot:title>
      {{ $t('text.logout') }}
    </template>
    <template v-slot:content>
      {{ $t('text.want_to_logout') }}
    </template>
    <template v-slot:footer>
      <button class="button-only-text js-close">
          <span class="text">{{ $t('text.cancel') }}</span>
      </button>
      <a href="{{ url('logout') }}" class="main-button main-button-small main-button-profile">
          <span class="text">{{ $t('text.yes') }}</span>
      </a> 
    </template>
  </popup-layout-simple>
</template>