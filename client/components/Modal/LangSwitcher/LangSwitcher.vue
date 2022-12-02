<script>
export default {
  data() {
    return {
      selectedIndex: 0
    }
  },

  props: {
    isActive: {
      type: Boolean,
      default: false
    }
  },

  computed: {
    availableLocales () {
      return this.$i18n.locales
    }
  },

  methods: {
    selectHandler() {
      this.$emit('select')
    }
  }
}
</script>

<style src="./lang-switcher.scss" lang="sass" scoped />

<template>
  <ul :class="{active: isActive}" class="footer__lang_list">
    <li
      v-for="locale in availableLocales"
      :key="locale.code"
      :class="{selected: selectedIndex}"
      @click="selectHandler"
    >
      <nuxt-link :to="switchLocalePath(locale.code)">
        <span class="footer__lang_language">
          {{ locale.name }}
        </span>
        
        <img v-if="$i18n.locale === locale.code" src="~assets/svg-icons/check.svg" class="icon" />
    	</nuxt-link>
    </li>
</ul>
</template>