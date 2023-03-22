<script setup>
  const props = defineProps({
    error: Object
  })

  console.log('props error', props.error)

  const {t} = useI18n({useScope: 'local'})
</script>

<style src="~/assets/scss/pages/error.scss" lang="scss" scoped />

<template>
  <NuxtLayout name="default">
    <div>
      <div class="container">
        <SimpleDecorator is-figure>
          <div class="error">
            <h1 class="title">404</h1>
            <p class="desc">{{ t('desc') }}</p>
            <SimpleMoreBtn link="/" :text="t('go_to_home')" class="btn"></SimpleMoreBtn>
          </div>
        </SimpleDecorator>
      </div>
      <section-write-us></section-write-us>
    </div>
  </NuxtLayout>
</template>
<i18n>
  {
    en: {
      desc: "The page you are looking for not availble",
      go_to_home: "Go to home page"
    },
    ru: {
      desc: "Страница, которую вы ищете, недоступна",
      go_to_home: "Перейти на главную страницу"
    }
  }
</i18n>