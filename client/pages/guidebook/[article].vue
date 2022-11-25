<script>
export default {
  data() {
    return {
      article: {
        title: 'КРАТОМ: СПОСОБЫ ПРИЁМА И ОБЩИЕ ЭФФЕКТЫ',
        image: null,
        content: `<p>В данной статье речь пойдёт о способах приёма измельчённых в порошок листьев Кратома и общих эффектах при таком способе употребления.

Психотропные эффекты Кратома весьма специфичны и могут иметь значительные различия в зависимости от целого ряда факторов, как то: сорт Кратома, место его произрастания, время сбора, способ потребления, индивидуальные особенности потребителей и пр.

Однако, наиболее стабильными и «предсказуемыми», наиболее яркими – являются такие эффекты как: психостимулирующее действие, релаксация, обезболивающее действие, некоторый антидепрессивный и общетонизирующий эффект.

Как известно, в западных странах Кратом доступен по большей мере в виде высушенных и истёртых в порошок листьев различных сортов. Такая «форма выпуска» не только позволяет сохранить все активные вещества листьев, но также делает возможным индивидуальный подбор дозировки в каждом отдельном случае.

Способов использования высушенных листьев существует немало, однако наиболее популярными являются:</p>`
      },
      similars: [
        {
          id: 1,
          title: 'BUY KRATOM IN SOUTH CAROLIN',
          image: null,
          short_desc: 'There is so much disinformation regarding Kratom products and their legality over the USA. It might be caused generally by the undefined status of the plant. Some believe',
          link: '/'
        },{
          id: 2,
          title: 'BUY KRATOM IN SOUTH CAROLIN',
          image: null,
          short_desc: 'There is so much disinformation regarding Kratom products and their legality over the USA. It might be caused generally by the undefined status of the plant. Some believe',
          link: '/'
        },{
          id: 3,
          title: 'BUY KRATOM IN SOUTH CAROLIN',
          image: null,
          short_desc: 'There is so much disinformation regarding Kratom products and their legality over the USA. It might be caused generally by the undefined status of the plant. Some believe',
          link: '/'
        }
      ]
    }
  }
}
</script>

<style src="assets/scss/pages/article.scss" lang="sass" scoped />

<template>
  <section class="wrapper">

      <div class="inner container">

          <div class="general-decor-figure"></div>
          <div class="general-decor-figure"></div>
          
          <div class="general-decor-text">kratom helper</div>

          <div class="hero-img">
              <img 
                :src="article.image" 
                :title="article.title" 
                :alt="article.title"
              />
          </div>

          <div class="content">
              <!-- <p class="date">{{ $article->toArray()['date'] }}</p> -->
              <h1 class="main-caption main-caption-align">{{ article.title }}</h1>
              
              <div class="narrow" v-html="article.content"></div>

              <a :href="guidebook" class="general-more">
                  <img src="~assets/svg-icons/arrow.svg" class="icon" />
                  <span class="text">{{ $t('text.back_to_all_articles') }}</span>
              </a>
          </div>
          
      </div>

      <div class="similar container">
          
        <p class="caption">{{ $t('text.similar_articles') }}</p>

          <ul class="grid">
              <guidebook-card
                v-for="article in similars"
                :key="article.id"
                :article="article"
              >
              </guidebook-card>
          </ul>
      </div>

  </section>
</template>