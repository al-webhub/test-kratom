<script>
import rewardsImg from 'assets/images/rewards.png'

export default {
  data() {
    return {
      page: {
        h1: 'EARN WITH US',
        title: 'EARN WITH US',
        compensation_mt_1: 'COMPENSATION',
        compensation_t_1: 'Compensation for orders',
        compensation_c_1: 'All registered users get the compensation for their orders. The compensation is equal to 1% of the order amount. It is saved in your personal cabinet and may be spent on any goods in our e-shop at any time;',
        compensation_t_2:'Volume discounts',
        compensation_c_2: 'We also have volume discounts: the more you buy, the cheaper the kratom cost per 1 gram is',
        compensation_t_3:'Money for feedback',
        compensation_c_3: 'Each you feedback brings you $1-2 on your personal account. You may use this money for any order in our e-shop. If your feedback includes a Facebook page link, you get $2, if not – just $1. If your feedback is a negative one, you get the money anyway. We are kindly asking you to write just honest feedbacks as far as they will be read by other visitors, who would like to be sure that your feedbacks are objective and honest.',
        program_mt_1: 'PARTNER PROGRAM',
        partner_program_info: 'We offer you to earn with us. We have a splendid referral program. You should not be registered as our Partner for this. Each registered user can generate a set of his/her own links. If a new customer registers and makes an order by following your link, you get 10% of this customer’s order amount. If this customer creates his/her own link and invites another customer (who makes an order), you get 5% of the latter’s customer’s order amount. And so on up to the third degree. The order in the third degree brings you 2% of an order amount. To get the money, the order must have a “sent” status. It means that the order was paid and sent. If the customer decides to return the order, it will not be your concern (as far as we are ready for such expenses). It should be noted that the money is real (not bonus), so you are able to get this money out any way you prefer. Your referral network will be seen in your personal cabinet, so you will have the possibility to check the orders of the people from your network yourself. Let’s earn together! Bring your friends to us!',
        htw_mt_1: 'HOW IT WORKS?',
        program_t_1: 'Registration',
        program_c_1: 'First af all, you need to register in our store. We will check all your actions for partnership and be able to count all your earnings. Full history is avaliable in your account',
        program_t_2: 'Choose earning ways',
        program_c_2: `Get referrals

Create your 3-level referral network!

Leave feedback

Leave incognito for $1 or from your account for $2

Buy kratom

Earn money buying kratom at our store`,
        program_t_3: 'Make request',
        program_c_3: 'Send us requests when you want to withdraw your money. We will proceed it within 1 day.',
        htw_info: `If a new client places an order using your link without registering, you get 10% of the order amount of this client one time, or as many times as he will place an order using the link without registering.

If a client has registered, you will constantly receive 10% from him, regardless of whether he came through your link or directly. The same thing happens with clients invited by your referral.

Follow the link - a one-time payment, constantly during registration. Second line of referrals - you get 5%, third line - 2%. The number of referrals is not limited.`
      }
    }
  },

  computed: {
    iconImg() {
      return 'url(' + rewardsImg + ')'
    }
  }
}
</script>

<style src="assets/scss/pages/rewards.scss" lang="sass" scoped />

<template>
  <section class="earn">
        <div class="earn__wrapper container">
            <div class="general-decor-figure"></div>
            <div class="general-decor-figure"></div>
            <div class="general-decor-text">kratom helper</div>
            <h1 class="main-caption main-caption-align">{{ page.h1 || page.title }}</h1>
            <div class="earn__compensation">
                
              <h2 class="main-caption-l">{{ page.compensation_mt_1 }}</h2>

                <ul class="earn__compensation__list">

                    <li class="earn__compensation__item">
                        <div class="general-decor-caption">
                            <div :style="{backgroundImage: iconImg}" class="img orders js-img-bg"></div>
                        </div>
                        <h3 class="main-caption-s">{{ page.compensation_t_1 }}</h3>
                        <div v-html="page.compensation_c_1"></div>
                    </li>

                    <li class="earn__compensation__item">
                        <div class="general-decor-caption">
                            <div :style="{backgroundImage: iconImg}" class="img discounts js-img-bg"></div>
                        </div>
                        <h3 class="main-caption-s">{{ page.compensation_t_2 }}</h3>
                        <div v-html="page.compensation_c_2"></div>
                    </li>

                    <li class="earn__compensation__item">
                        <div class="general-decor-caption">
                            <div :style="{backgroundImage: iconImg}" class="img money js-img-bg"></div>
                        </div>
                        <h3 class="main-caption-s">{{ page.compensation_t_3 }}</h3>
                        <div v-html="page.compensation_c_3"></div>
                    </li>

                </ul>
            </div>

            <div class="earn__partner-programm">
                <h2 class="main-caption-l">{{ page.program_mt_1 }}</h2>
                <div v-html="page.partner_program_info"></div>
            </div>

            <div class="earn__how-works">
                <h2 class="main-caption-l">{{ page.htw_mt_1 }}</h2>
                <ul class="earn__how-works__list">
                    <li class="earn__how-works__item">
                        <div class="number-wrapper">
                            <p class="number">1.</p>
                        </div>
                        <p class="main-caption-s">{{ page.program_t_1 }}</p>
                        <div v-html="page.program_c_1"></div>
                    </li>
                    <li class="earn__how-works__item">
                        <div class="number-wrapper">
                            <p class="number">2.</p>
                        </div>
                        <p class="main-caption-s">{{ page.program_t_2 }}</p>
                        <div v-html="page.program_c_2"></div>
                    </li>
                    <li class="earn__how-works__item">
                        <div class="number-wrapper">
                            <p class="number">3.</p>
                        </div>
                        <p class="main-caption-s">{{ page.program_t_3 }}</p>
                        <div v-html="page.program_c_3"></div>
                    </li>
                </ul>
            </div>
            <div class="earn__text" v-html="page.htw_info"> 
            </div>
        </div>
    </section>

    <section-referral></section-referral>

</template>