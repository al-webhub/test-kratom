<script>
export default {
  setup() {
    const route = useRoute()
    const { t } = useI18n()
    const head = useLocaleHead({
      addDirAttribute: true,
      identifierAttribute: 'id',
      addSeoAttributes: true
    })
    const title = computed(() => t('layouts.title', { title: t(route.meta.title ?? 'TBD') }))
    
    
    const breadcrumbsIsActive = ref(route.meta.breadcrumbsIsActive === undefined? true: route.meta.breadcrumbsIsActive)

    watch(route, async (route) => {
      breadcrumbsIsActive.value = route.meta.breadcrumbsIsActive === undefined? true: route.meta.breadcrumbsIsActive
    })

    return {
      head,
      title,
      breadcrumbsIsActive
    }
  }
}
</script>

<template>
  <div>
    <Html :lang="head.htmlAttrs.lang" :dir="head.htmlAttrs.dir">
      <Head>
        <Title>{{ title }}</Title>
        <template v-for="link in head.link" :key="link.id">
          <Link :id="link.id" :rel="link.rel" :href="link.href" :hreflang="link.hreflang" />
        </template>
        <template v-for="meta in head.meta" :key="meta.id">
          <Meta :id="meta.id" :property="meta.property" :content="meta.content" />
        </template>
      </Head>
      <Body>
        <the-header></the-header>

        <transition name="fade-in">
          <the-breadcrumbs v-if="breadcrumbsIsActive"></the-breadcrumbs>
        </transition>

        <modal-noty></modal-noty>

        <main>
          <slot />
        </main>

        <the-footer></the-footer>

        <modal-cart></modal-cart>

        <popup-adult></popup-adult>

        <popup-check-money></popup-check-money>

        <popup-auth-change-password></popup-auth-change-password>
        <popup-auth-log-in-email></popup-auth-log-in-email>
        <popup-auth-log-in-password></popup-auth-log-in-password>
        <popup-auth-log-out></popup-auth-log-out>
        <popup-auth-sign-in-social></popup-auth-sign-in-social>
        <popup-auth-sign-in-email></popup-auth-sign-in-email>

        <section class="push_notification">
          <ul class="push_notification__list">
          </ul>
        </section>
      </Body>
    </Html>
  </div>
</template>