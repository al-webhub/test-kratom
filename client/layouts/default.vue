<template>
  <div>
    <the-header></the-header>

    <the-breadcrumbs></the-breadcrumbs>

    <main>
      <slot />
    </main>

    <the-footer></the-footer>

    <modal-cart></modal-cart>

    <popup-adult></popup-adult>

    <popup-sign-out></popup-sign-out>

    <popup-check-money></popup-check-money>

    <popup-sign-in-social></popup-sign-in-social>

    <section class="push_notification">
      <ul class="push_notification__list">
      </ul>
    </section>
  </div>
</template>