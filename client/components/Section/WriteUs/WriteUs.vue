<script>
export default {
  setup() {
    const { t } = useI18n({
      useScope: 'local'
    }) 

    return {
      t
    }
  },

  computed: {
    items() {
      const contacts = useContacts()
      
      return {
        mail: contacts.email,
        telegram: contacts.telegram,
        whatsapp: contacts.whatsapp,
        skype: contacts.skype,
        viber: contacts.viber
      }
    }
  },

}
</script>

<style src="./write-us.scss" lang="sass" scoped />

<template>
  <section class="qb">

    <nuxt-img
      src = "/images/question-block-img.png"
      height="304"
      sizes = "mobile:100vw desktop:100vw"
      format = "webp"
      quality = "20"
      loading = "lazy"
      class="bg-image"
    ></nuxt-img>

    <div class="wrapper container">
      <div class="inner">
        <p class="main-caption">{{ t('have_any_questions') }}</p>
        
        <p class="sub">{{ t('write_to_us') }}</p>

        <ul class="list">
          <li v-for="(item, key) in items" :key="key" :class="key + '-color'" class="item">
            <a :href="item.link" class="link">
              <img :src="item.icon" class="icon" />
            </a>
          </li>
        </ul>

      </div>
    </div>
  </section>
</template>

<i18n>
  {
    "en": {
      "have_any_questions" : "have any questions?",
      "write_to_us" : "Write to us",
    },
    "ru": {
      "have_any_questions" : "остались вопросы?",
      "write_to_us" : "Напишите нам",
    }
  }
</i18n>