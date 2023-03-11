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
      isLoading: false,
      errors: {}
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
      
      await this.profileStore?.updateProfile()
        .then((profile) => {
          this.errors = {}
          useNoty().setNoty(this.$t('noty.update_success'))
        })
        .catch((e) => {
          this.errors = e
          useNoty().setNoty(this.$t('noty.update_fail'))
        }).finally(() => {
          this.isLoading = false
        }) 
    }
  },

  created() {
    this.setCrumbs()
  }
}
</script>

<style src="./addresess.scss" lang="sass" scoped />

<i18n src="./messages.json"></i18n>

<template>
  <div class="profile__address">
    <div v-if="address" class="profile__form__body">

      <form-checkbox
        v-model="address.is_default"
        :error="errors['addresses.0.is_default']"
        value="is_default"
        class="form-component input__wrapper100"
      >
        <p>{{ t('Use_the_addresses') }}</p>
      </form-checkbox>

      <form-select
        v-model="address.country"
        :placeholder="$t('form.Country_Region')"
        :values="countries"
        :error="errors['addresses.0.country']"
        class="form-component"
      >
      </form-select>

      <form-text
        v-model="address.street"
        :placeholder="$t('form.Street_Number')"
        :error="errors['addresses.0.street']"
        class="form-component"
      >
      </form-text>

      <form-text
        v-model="address.apartment"
        :placeholder="$t('form.Apartment_house_flat')"
        :error="errors['addresses.0.apartment']"
        class="form-component"
      >
      </form-text>

      <form-text
        v-model="address.city"
        :placeholder="$t('form.Town_City')"
        :error="errors['addresses.0.city']"
        class="form-component"
      >
      </form-text>

      <form-text
        v-model="address.state"
        :placeholder="$t('form.State')"
        :error="errors['addresses.0.state']"
        class="form-component"
      >
      </form-text>

      <form-text
        v-model="address.zip"
        :placeholder="$t('form.ZIP')"
        :error="errors['addresses.0.zip']"
        class="form-component"
      >
      </form-text>

      <form-textarea
        v-model="address.comment"
        :placeholder="t('Specify_or_write')"
        :error="errors['addresses.0.comment']"
        class="form-component input__wrapper100"
      >
      </form-textarea>
      
    </div>
    
    <div class="profile__form__footer">
      <button @click="saveHandler" :class="{loading: isLoading}" clickable class="main-button primary-color bordered small">
        <span class="text">{{ $t('button.save_address') }}</span>
      </button>
    </div>

  </div>
</template>