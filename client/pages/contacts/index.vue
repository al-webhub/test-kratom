<script>
import {useFeedbackStore} from '~/store/feedback'

export default {
  setup() {
    const feedbackStore = useFeedbackStore()
    const { t } = useI18n({useScope: 'local'}) 
  
    const breadcrumbs = [
      {
        name: t('crumbs.home'),
        item: useToLocalePath()('/')
      },{
        name: t('crumbs.contacts'),
        item: useToLocalePath()('/contacts')
      }
    ]

    useCrumbs().setCrumbs(breadcrumbs)

    useSchemaOrg([
      defineBreadcrumb({
        itemListElement: breadcrumbs
      }),
    ])

    return {
      t,
      feedbackStore
    }
  },

  data() {
    return {
      isLoading: false,
      feedback: {
        name: null,
        email: null,
        text: null,
        type: 'Contact page'
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

    errors() {
      return this.feedbackStore.errors
    }
  },

  methods: {
    async sendHandler() {
      this.isLoading = true
      try {
        await this.feedbackStore.createFeedback(this.feedback)
          .then((res) => {
              useNoty().setNoty(this.$t('noty.message_success'))
              
              this.feedback.name = null
              this.feedback.email = null
              this.feedback.text = null
            })
        }catch(e) {
            useNoty().setNoty(this.$t('noty.message_fail'))
        }finally {
          this.isLoading = false
        }
    }
  },
}
</script>

<style src="./contacts.scss" lang="sass" scoped />

<i18n src="./messages.json"></i18n>

<template>
<div>
  <simple-decor>
    <section class="contact">
        <div class="container">
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
                      <img :src="contact.icon" class="icon" alt="contact icon" />
                      <a :href="contact.link" :aria-label="contact.text" class="contacts-link">{{ contact.text }}</a>
                    </li>
                  </ul>
                </div>

                <div class="socials mb">
                  <p class="contact-caption">{{ page.title2 }}</p>

                  <ul class="socials-list">
                    <li v-for="(item, key) in socials" :key="key" class="socials-item">
                      <a :href="item.link" :class="key + '-color'" :aria-label="key" class="socials-link">
                        <img :src="item.icon" :alt="key + ' icon'" class="icon" />
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
                    :error="errors?.name"
                    class="form-item"
                  />
                  
                  <form-text 
                    v-model="feedback.email"
                    :placeholder="$t('form.email')"
                    :error="errors?.email"
                    class="form-item"
                  />
                  
                  <form-textarea 
                    v-model="feedback.text"
                    :placeholder="$t('form.your_comment')"
                    :error="errors?.text"
                    class="form-item"
                  />

                  <button
                    @click="sendHandler"
                    :class="{loading: isLoading}"
                    :aria-label="$t('button.send_message')"
                    class="main-button primary-color form-item btn"
                    type="button"
                    clickable
                  >
                    <span class="text">{{ $t('button.send_message') }}</span>
                  </button>
                </div>
              </div>
              
            </div>
        </div>
    </section>
  </simple-decor>
</div>
</template>