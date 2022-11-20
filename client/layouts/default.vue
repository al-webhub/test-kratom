<template>
  <div>
    <the-header></the-header>

    <main>
      <slot />
    </main>


    <section class="push_notification">
        <ul class="push_notification__list">
        </ul>
    </section>
  </div>
</template>