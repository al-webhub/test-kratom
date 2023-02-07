<script>
import call_img from 'assets/svg-icons/promo/call.svg';
import track_img from 'assets/svg-icons/promo/track.svg';
import wallet_img from 'assets/svg-icons/promo/wallet.svg';
import diamond_img from 'assets/svg-icons/promo/diamond.svg';

export default {
  setup() {
    const { t, locale } = useI18n({useScope: 'local'})

    return {
      t,
    }
  },

  data() {
    return {}
  },

  computed: {
    page() {
      return {
        h1: this.t('title'),
        adv: [
          {
            title: this.t('adv_t_1'),
            content: this.t('adv_c_1'),
            image: call_img,
          },{
            title: this.t('adv_t_2'),
            content: this.t('adv_c_2'),
            image: track_img,
          },{
            title: this.t('adv_t_3'),
            content: this.t('adv_c_3'),
            image: wallet_img,
          },{
            title: this.t('adv_t_4'),
            content: this.t('adv_c_4'),
            image: diamond_img,
          }
        ]
      }
    }
  },

  methods: {
    setCrumbs() {
      useCrumbs().setCrumbs([
          {
            name: this.$t('crumbs.home'),
            link: '/'
          },{
            name: this.$t('crumbs.our_advantages'),
            link: '/our-advantages'
          }
      ])
    },

  },

  async created() {
    this.setCrumbs()
  }

}
</script>

<style src="./advantages.scss" lang="sass" scoped />

<template>
  <section class="our-advantages-page">
    <div class="our-advantages-page__wrapper container">
        
      <h1 class="main-caption main-caption-align">{{ page.h1 }}</h1>
        
        <ul class="our-advantages__list">
            
            <li
              v-for="(adv, index) in page.adv"
              :key="index"
              class="our-advantages__item"
              id="consultation"
            >
                <div class="img">
                    <img :src="adv.image" class="icon" />
                </div>

                <h2 class="caption">{{ adv.title }}</h2>
                <div class="text">{{ adv.content }}</div>
            </li>
        </ul>
    </div>
    
    <section-write-us></section-write-us>

  </section>
</template>
<i18n>
  {
    en: {
      title: "Our advantages",
      adv_t_1: "Consultation",
      adv_t_2: "Return the money",
      adv_t_3: "Fast delivery",
      adv_t_4: "Quality",
      adv_c_1: "We are always ready to listen to your requests, to your aim of kratom intaking; we would gladly give you our advice and any kind of consultation. We have a wealth of experience and a great number of clients from different countries, who we are on friendly terms with.",
      adv_c_2: "We are fully aware of the fact that kratom is not a pharmaceutical drug, but a natural plant. Consequently, there are the people who may not like it. In such a case, we are ready to return you the money back. We do never insist on selling and we are not going to persuade you to get the order as far as we are not able to return you the money back. On the contrary, we will easily do it.",
      adv_c_3: "We are able to send you the order by any post service you choose (from the fastest, but the most expensive post service to the slowest, but the cheapest one). We will discuss this matter with you and decide which delivery type is going to be the best in your case. We are also always ready to help you to get the order in your country without any delay. We are aware of all customs formalities and would always assist you in getting of your order without any risks.",
      adv_c_4: "And the most important thing! The quality. Just trust us in the following matter: there are hundreds of kratom sellers all over the world, but just a few of them possess kratom which starts to effect after intaking just 2-3 grams of it. Once in Pontianak I tasted the kratom of a local wholesaler. I intook 10 grams (that is my usual dosage), but the effect appeared to be a rather weak one. I complained of this and he answered that his Indonesian kratom was of the highest quality, and there was an American reseller who bought tons of it. It is really frightful to think that the American people intake so much of a real crap. That is truly awful! So, just order 100 grams of our kratom and you will know what a real “quality” is.",
    },
    ru: {
      title: "Наши преимущества",
      adv_t_1: "Консультация",
      adv_t_2: "Возврат средств",
      adv_t_3: "Быстрая доставка",
      adv_t_4: "Качество",
      adv_c_1: "Мы всегда готовы выслушать ваши пожелания, касающиеся вашей цели приема кратома; мы с радостью дадим вам совет и любую консультацию. У нас большой опыт и большое количество клиентов из разных стран, с которыми мы дружим.",
      adv_c_2: "Мы полностью осознаем тот факт, что кратом - это не фармацевтический препарат, а натуральное растение. Следовательно, есть люди, которым это может не понравиться. В таком случае мы готовы вернуть вам деньги обратно. Мы никогда не настаиваем на продаже и не будем уговаривать вас оформить заказ, поскольку не можем вернуть вам деньги. Напротив, мы легко это сделаем",
      adv_c_3: "Мы можем отправить вам заказ любой почтовой службой по вашему выбору (от самой быстрой, но самой дорогой почтовой службы до самой медленной, но самой дешевой). Мы обсудим с вами этот вопрос и решим, какой тип доставки будет оптимальным в вашем случае. Также мы всегда готовы помочь Вам без промедления получить заказ в Вашей стране. Мы осведомлены обо всех таможенных формальностях и всегда поможем Вам оформить заказ без каких-либо рисков.",
      adv_c_4: "И самое главное! Качество. Доверьтесь нам в следующем: во всем мире есть сотни продавцов кратома, но лишь немногие из них обладают кратомом, который начинает действовать после приема всего 2-3 грамма. Однажды в Понтианаке я попробовал кратом местного оптовика. Я выпила 10 граммов (это моя обычная дозировка), но эффект оказался довольно слабым. Я пожаловался на это, и он ответил, что его индонезийский кратом высшего качества, и что один американский торговый посредник купил его тонны. Действительно ужасно думать, что американский народ потребляет столько настоящего дерьма. Это действительно ужасно! Так что просто закажите у нас 100 грамм кратома и вы поймете, что такое настоящее &laquo;качество&raquo;.",
    }
  }
</i18n>