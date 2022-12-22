<script>
export default {
  data() {
    return {
      page: {
        h1: 'About us',
        title: '',
        image_1: null,
        title_1: 'THING THAT DIFFERS US FROM OTHER SELLERS',
        content_1:'To start with, we would like to inform you about the thing that differs us from other sellers. All of them will assure you that their kratom is of the highest quality. But is it not possible for everyone to have it. We are really aware of this fact as far as we travelled to Indonesia and visited different Indonesian islands ourselves. This way, we know exactly what “the kratom at first hand” is, we know the way it is grown, we know the people who handle it, we know its value among the local people, and we know which type has the highest value.',
        q_1: `We know exactly what “the kratom at first hand” is, we know the way it is grown, we know the people who handle it, we know its value among the local people, and we know which type has the highest value.`,
        title_2: 'WE TRAVELED INTO THE DEPTH OF BORNEO TO FIND REALLY GOOD AND RESPONSIBLE PLANTATION OWNERS',
        content_2: 'Every third person in Indonesia on the Borneo Island is a kratom seller, but there are no plantation owners among them. It is well known, that quite frequently the people are really good either at production or at selling. Those who are good at selling may get the production from a person, who is far from being a good producer. A producer himself is not good at selling, he/she has no possibility to blog on social networks and to have a good website. It is much easier for a plantation owner to sell kratom from the warehouse, and to concentrate on kratom growing. So we travelled into the depth of Borneo in order to find really good and responsible plantation owners.',
        image_2: null,
        image_3: null,
        content_3: 'We tasted hundreds of kratom types and understood that good quality is worth the money. It is better to deal with faithful people, who practice proper hygiene while hand-picking and drying, and pay them more money than to deal with those, who produce tons of stuff and store it in the dirty warehouses. If you are looking for “kosher” kratom with an honest name, which was supplied by tidy plantation owners, just try our kratom. We would appreciate our friendship!',
      }
    }
  }
}
</script>

<style src="assets/scss/pages/about-us.scss" lang="sass" scoped />

<template>
  <div>
    <section class="about-us-page">
        <div class="about-us-page__wrapper container">
            <!-- <div class="general-decor-figure"></div>
            <div class="general-decor-text">about us</div> -->
            <h1 class="main-caption main-caption-align">{{ page.h1 || page.title }}</h1>
            <div class="about-us-page__container">
                <div :style="{backgroundImage: 'url(' + page.image_1 + ')'}" class="about-us-page__main-img js-img-bg"></div>
                <div class="about-us-page__content">
                    <h2 class="about-us-page__content__caption">{{ page.title_1 }}</h2>
                    <p>{{ page.content_1 }}</p>
                    <div class="main">
                        <p>{{ page.q_1 }}</p>
                    </div>
                    <h2 class="about-us-page__content__caption">{{ page.title_2 }}</h2>
                    <p>{{ page.content_2 }}</p>
                    <div class="about-us-page__img-group about-us-page__img-group-tablet">
                        <div :style="{backgroundImage: 'url(' + page.image_2 + ')'}" class="img js-img-bg"></div>
                        <div :style="{backgroundImage: 'url(' + page.image_3 + ')'}" class="img js-img-bg"></div>
                    </div>
                    <p>{{ page.content_3 }}</p>
                </div>
                <div class="about-us-page__img-group">
                    <div :style="{backgroundImage: 'url(' + page.image_2 + ')'}" class="img js-img-bg"></div>
                    <div :style="{backgroundImage: 'url(' + page.image_3 + ')'}" class="img js-img-bg"></div>
                </div>
            </div>
        </div>
    </section>

    <section-write-us></section-write-us>
  </div>
</template>