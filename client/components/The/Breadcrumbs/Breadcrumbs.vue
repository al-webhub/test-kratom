<script>
export default {
  props: {
    crumbs: Array,
    required: true
  }
}
</script>

<style src="./breadcrumbs.scss" lang="sass" scoped />

<template>
  <section class="breadcrumbs">
    <div class="container">
      <ul class="list">
        <li class="item">
          <a href="https://kratomhelper.com" class="breadcrumbs__link">Главная</a>
        </li>
        <li class="item">
          <a href="https://kratomhelper.com/guidebook" class="breadcrumbs__link">Журнал</a>
        </li>
        <li class="item">
          <a href="http://kratom.parabee8.beget.tech" class="breadcrumbs__link">Кратом: способы приёма и общие эффекты</a>
        </li>
      </ul>
    </div>
  </section>
</template>