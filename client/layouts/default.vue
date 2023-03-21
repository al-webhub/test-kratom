<script setup>
  import { useModalStore } from '~/store/modal';
  import { useAppPersistStore } from '~/store/appPersist'
  import { useAuthStore } from '~/store/auth';

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
    return useModalStore().show('cart')
  })

  const isPopupAdultActive = computed(() => {
    return useAppPersistStore().adult
  })

  const isPopupAuthSignInSocialActive = computed(() => {
    return useModalStore().show('signInSocial')
  })

  const isPopupAuthSignInEmailActive = computed(() => {
    return useModalStore().show('signInEmail')
  })

  const isPopupAuthPasswordResetActive = computed(() => {
    return useModalStore().show('resetPassword')
  })

  const isPopupAuthChangePasswordActive = computed(() => {
    return useModalStore().show('changePassword')
  })

  const isPopupAuthLogInEmailActive = computed(() => {
    return useModalStore().show('logInEmail')
  })

  const isPopupAuthLogInPasswordActive = computed(() => {
    return useModalStore().show('logInPassword')
  })

  const isPopupAuthLogOutActive = computed(() => {
    return useModalStore().show('logOut')
  })
  
  const isPopupPcActive = computed(() => {
    return useModalStore().show('pc')
  })

  // HOOKES
  onMounted(() => {
    // LOGIN USER BY TOKEN
    const token = route.query?.token

    if(token){
      nextTick(() => {
        useAuthStore().getUserByToken(token)
          .then((data) => {
            useNoty().setNoty(t('noty.login_success'), 3000)
          }).catch(() => {
            useNoty().setNoty(t('noty.login_failed'), 5000)
          }).finally(() => {
            navigateTo('/')
          })
      })
    }

    // Change password
    if(route.query?.newpassword && route.query?.email && route.query?.t) {
      useModalStore().open('changePassword')
    }
  })
  
  useSchemaOrg([
    defineWebSite({
      name: 'Kratomhelper.com',
    }),
    defineWebPage(),
  ])
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
        <Meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no" />
      </Head>
      <Body>
        <the-header></the-header>

        <transition name="fade-in">
          <the-breadcrumbs v-if="breadcrumbsIsActive"></the-breadcrumbs>
        </transition>

        <main>
          <slot />
        </main>

        <lazy-the-footer></lazy-the-footer>

        <!-- Clicker show ellipse were mouse have been clicked -->
        <simple-clicker></simple-clicker>

        <DelayHydration>
          <lazy-modal-noty></lazy-modal-noty>

          <!-- POPUP / Fill in the key data -->
          <transition name="fade-in">
            <lazy-popup-p-c v-if="isPopupPcActive"></lazy-popup-p-c>
          </transition>

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

          <!-- POPUP / reset password -->
          <transition name="fade-in">
            <lazy-popup-auth-password-reset v-if="isPopupAuthPasswordResetActive"></lazy-popup-auth-password-reset>
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
        </DelayHydration>
      </Body>
    </Html>
  </div>
</template>