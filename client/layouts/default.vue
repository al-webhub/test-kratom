<script>
import { useCartStore } from '~/store/cart';
import { useAppStore } from '~/store/app'
import { useAuthStore } from '~/store/auth';

export default {
  setup() {
    const route = useRoute()
    const { t } = useI18n()
    const head = useLocaleHead({
      addDirAttribute: true,
      identifierAttribute: 'id',
      addSeoAttributes: true
    })
    
    const title = "Kratomhelper";
    
    const breadcrumbsIsActive = ref(route.meta.breadcrumbsIsActive === undefined? true: route.meta.breadcrumbsIsActive)

    watch(route, async (route) => {
      breadcrumbsIsActive.value = route.meta.breadcrumbsIsActive === undefined? true: route.meta.breadcrumbsIsActive
    })

    // COMPUTED
    const isModalCartActive = computed(() => {
      return useCartStore().show
    })

    const isPopupAdultActive = computed(() => {
      return useAppStore().adult
    })

    const isPopupAuthSignInSocialActive = computed(() => {
      return useAuthStore().showSignInSocial
    })

    const isPopupAuthSignInEmailActive = computed(() => {
      return useAuthStore().showSignInEmail
    })

    const isPopupAuthChangePasswordActive = computed(() => {
      return useAuthStore().showChangePassword
    })

    const isPopupAuthLogInEmailActive = computed(() => {
      return useAuthStore().showLogInEmail
    })

    const isPopupAuthLogInPasswordActive = computed(() => {
      return useAuthStore().showLogInPassword
    })

    const isPopupAuthLogOutActive = computed(() => {
      return useAuthStore().showLogOut
    })
    

    return {
      isModalCartActive,
      isPopupAdultActive,
      isPopupAuthSignInSocialActive,
      isPopupAuthSignInEmailActive,
      isPopupAuthChangePasswordActive,
      isPopupAuthLogInEmailActive,
      isPopupAuthLogInPasswordActive,
      isPopupAuthLogOutActive,
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
        <Meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
      </Head>
      <Body>
        <the-header></the-header>

        <transition name="fade-in">
          <the-breadcrumbs v-if="breadcrumbsIsActive"></the-breadcrumbs>
        </transition>

        <main>
          <slot />
        </main>

        <the-footer></the-footer>

        <lazy-modal-noty></lazy-modal-noty>

        <!-- MODAL / shoping cart -->
        <transition name="move-x-right">
          <lazy-modal-cart v-if="isModalCartActive"></lazy-modal-cart>
        </transition>

        <!-- POPUP / has 18? -->
        <transition name="fade-in">
          <lazy-popup-adult v-if="isPopupAdultActive"></lazy-popup-adult>
        </transition>

        <!-- POPUP / main auth entry -->
        <transition name="fade-in">
          <lazy-popup-auth-sign-in-social v-if="isPopupAuthSignInSocialActive"></lazy-popup-auth-sign-in-social>
        </transition>

        <!-- POPUP / registration -->
        <transition name="fade-in">
          <lazy-popup-auth-sign-in-email v-if="isPopupAuthSignInEmailActive"></lazy-popup-auth-sign-in-email>
        </transition>

        <!-- POPUP / change password -->
        <transition name="fade-in">
          <lazy-popup-auth-change-password v-if="isPopupAuthChangePasswordActive"></lazy-popup-auth-change-password>
        </transition>

        <!-- POPUP / log in 1 step -->
        <transition name="fade-in">
          <lazy-popup-auth-log-in-email v-if="isPopupAuthLogInEmailActive"></lazy-popup-auth-log-in-email>
        </transition>

        <!-- POPUP / log in 2 step -->
        <transition name="fade-in">
          <lazy-popup-auth-log-in-password v-if="isPopupAuthLogInPasswordActive"></lazy-popup-auth-log-in-password>
        </transition>

        <!-- POPUP / log out -->
        <transition name="fade-in">
          <lazy-popup-auth-log-out v-if="isPopupAuthLogOutActive"></lazy-popup-auth-log-out>
        </transition>

        <!-- POPUP / check money -->
        <transition name="fade-in">
          <lazy-popup-check-money v-if="false"></lazy-popup-check-money>
        </transition>

      </Body>
    </Html>
  </div>
</template>