<script>
export default {
  data() {
    return {}
  },

  props: {
    articles: {
      type: Array,
      required: true
    }
  }
}
</script>

<style src="./articles.scss" lang="sass" scoped />

<template>
  <section class="article">
      <div class="article__wrapper container">
          <h2 class="main-caption">{{ $t('text.articles') }}</h2>
          <ul class="article__list article__list-main">
              <li
                v-for="(article, index) in articles"
                :key="article.id"
                class="article__item"
              >
                <div class="article__item__img">
                  <img
                    :src="article.image"
                    :alt="article.title"
                    :title="article.title"
                  />
                </div>

                <p class="article__item__caption">{{ article.title }}</p>

                <div class="article__item__text">{{ article.short_desc }}</div>
                
                <a :href="article.link" class="general-more">
                    <span class="text">{{ $t('text.read_more') }}</span>
                    <span class="icon-arrow-right"></span>
                </a>
              </li>
          </ul>
          <a href="guidebook" class="main-button">
              <span class="text">{{ $t('text.go_guidebook') }}</span>
          </a>
      </div>
  </section>
</template>