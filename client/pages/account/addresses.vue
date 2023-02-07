<script>
import { useProfileStore } from '~/store/profile';

export default {
  setup() {
    const { t } = useI18n({useScope: 'local'}) 
    const profileStore = useProfileStore()

    definePageMeta({
      layout: 'account',
      middleware: 'auth'
    })

    useAccount().setTitle(t('title.addresses'))

    return {
      profileStore,
      t
    }
  },

  data(){
    return {
      isLoading: false
    }
  },

  computed: {
    profile() {
      return this.profileStore?.profile;
    },

    address() {
      return this.profile?.addresses[0] || null
    },

    countries () {
      return useCountries()
    }
  },

  methods: {
    setCrumbs() {
      useCrumbs().setCrumbs([
          {
            name: this.$t('crumbs.home'),
            link: '/'
          },{
            name: this.$t('crumbs.account'),
            link: '/account'
          },{
            name: this.$t('crumbs.addresses'),
            link: '/account/addresses'
          }
      ])
    },

    async saveHandler() {
      this.isLoading = true
      
      await this.profileStore?.updateProfile().then((res) => {
        if(res.data._value)
          useNoty().setNoty(this.$t('noty.update_success'))
        
        if(res.error._value)
          useNoty().setNoty(this.$t('noty.update_fail'))

        this.isLoading = false
      })
    }
  },

  created() {
    this.setCrumbs()
  }
}
</script>

<style src="assets/scss/pages/account/addresess.scss" lang="sass" scoped />

<template>
  <div class="profile__address">
    <div v-if="address" class="profile__form__body">

      <form-checkbox
        v-model="address.is_default"
        value="is_default"
        class="form-component input__wrapper100"
      >
        <p>{{ t('Use_the_addresses') }}</p>
      </form-checkbox>

      <form-select
        v-model="address.country"
        :placeholder="$t('form.Country_Region')"
        :values="countries"
        class="form-component"
      >
      </form-select>

      <form-text
        v-model="address.street"
        :placeholder="$t('form.Street_Number')"
        class="form-component"
      >
      </form-text>

      <form-text
        v-model="address.apartment"
        :placeholder="$t('form.Apartment_house_flat')"
        class="form-component"
      >
      </form-text>

      <form-text
        v-model="address.city"
        :placeholder="$t('form.Town_City')"
        class="form-component"
      >
      </form-text>

      <form-text
        v-model="address.state"
        :placeholder="$t('form.State')"
        class="form-component"
      >
      </form-text>

      <form-text
        v-model="address.zip"
        :placeholder="$t('form.ZIP')"
        class="form-component"
      >
      </form-text>

      <form-textarea
        v-model="address.comment"
        :placeholder="t('Specify_or_write')"
        class="form-component input__wrapper100"
      >
      </form-textarea>
      
    </div>
    
    <div class="profile__form__footer">
      <button @click="saveHandler" :class="{loading: isLoading}" class="main-button primary-color bordered small">
        <span class="text">{{ $t('button.save_address') }}</span>
      </button>
    </div>

  </div>
</template>

<i18n>
  {
    "en": {
      "Use_the_addresses" : "Use the addresses on the default checkout page",
      "Specify_or_write" : "Specify or write your full address here",
    },
    "ru": {
      "Use_the_addresses" : "Использовать адрес на странице оформления заказа по умолчанию",
      "Specify_or_write" : "Укажите детали или напишите свой полный адрес здесь",
    }
  }
</i18n>