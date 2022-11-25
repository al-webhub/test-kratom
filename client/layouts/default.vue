<template>
  <div>
    <the-header></the-header>

    <the-breadcrumbs></the-breadcrumbs>

    <main>
      <slot />
    </main>

    <the-footer></the-footer>

    <section class="push_notification">
        <ul class="push_notification__list">
        </ul>
    </section>
  </div>
</template>