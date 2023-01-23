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

  data() {
    return {
      feedback: {
        name: null,
        email: null,
        content: null,
      },
    }
  },

  computed: {
    page() {
      return {
        h1: this.t('contacts'),
        content: this.t('desc'),
        title1: this.t('contact_to_us'),
        title2: this.t('write_throw_messanger'),
        title3: this.t('write_to_us')
      }
    },

    socials() {
      const contacts = useContacts()
      
      return {
        mail: contacts.email,
        telegram: contacts.telegram,
        whatsapp: contacts.whatsapp,
        skype: contacts.skype,
        viber: contacts.viber
      }
    },
    contacts() {
      const contacts = useContacts()

      return [
        contacts.address,
        contacts.email,
        contacts.phone,
      ]
    },

  },

  methods: {

    setCrumbs() {
      useCrumbs().setCrumbs([
          {
            name: this.$t('crumbs.home'),
            link: '/'
          },{
            name: this.$t('crumbs.contacts'),
            link: '/contacts'
          }
      ])
    },

    sendHandler() {
      useNoty().setNoty(this.$t('noty.message_success'))
      this.feedback.name = null
      this.feedback.email = null
      this.feedback.content = null
    }
  },

  async created() {
    this.setCrumbs()
  }
}
</script>

<style src="assets/scss/pages/contacts.scss" lang="sass" scoped />

<i18n src="./messages.json"></i18n>

<template>
<div>
  <section class="contact">
      <!-- <div class="general-decor-text">kratom helper</div> -->
      <div class="container">
          <!-- <div class="general-decor-figure"></div> -->
          
          <h1 class="main-caption main-caption-align">{{ page.h1 || page.title }}</h1>

          <div class="inner">
            
            <div class="left">
          
              <div class="text mb">
                <span class="general-decor-elem"></span>
                <div v-html="page.content"></div>
              </div>

              <div class="contacts mb">
                <p class="contact-caption">{{ page.title1 }}</p>

                <ul class="contacts-list">
                  <li
                    v-for="(contact, index) in contacts"
                    :key="index"
                    class="contacts-item"
                  >
                    <img :src="contact.icon" class="icon" />
                    <a :href="contact.link" class="contacts-link">{{ contact.text }}</a>
                  </li>
                </ul>
              </div>

              <div class="socials mb">
                <p class="contact-caption">{{ page.title2 }}</p>

                <ul class="socials-list">
                  <li v-for="(item, key) in socials" :key="key" class="socials-item">
                    <a :href="item.link" :class="key + '-color'" class="socials-link">
                      <img :src="item.icon" class="icon" />
                    </a>
                  </li>
                </ul>
              </div>
            </div>

            <div class="right">
              <div class="form">
                <p class="contact-caption">{{ page.title3 }}</p>

                <form-text 
                  v-model="feedback.name"
                  :placeholder="$t('form.first_name')"
                  class="form-item"
                />
                
                <form-text 
                  v-model="feedback.email"
                  :placeholder="$t('form.email')"
                  class="form-item"
                />
                
                <form-textarea 
                  v-model="feedback.content"
                  :placeholder="$t('form.your_comment')"
                  class="form-item"
                />

                <button @click="sendHandler" class="main-button primary-color form-item btn">
                  <span class="text">{{ $t('button.send_message') }}</span>
                </button>
              </div>
            </div>
            
          </div>
      </div>
  </section>
</div>
</template>