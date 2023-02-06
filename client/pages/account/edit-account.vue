<script>
import { useProfileStore } from '~/store/profile';
import { useAuthStore } from '~/store/auth';

export default {
  setup() {
    definePageMeta({
      layout: "account",
      middleware: 'auth'
    })

    const profileStore = useProfileStore()
    const authStore = useAuthStore()

    return {
      profileStore,
      authStore
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

    errors() {
      return {}
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
            name: this.$t('crumbs.edit_account'),
            link: '/account/edit_account'
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
    },

    changePassHandler() {
      this.authStore.open('changePassword')
    }
  },

  created() {
    this.setCrumbs()
  }
}
</script>

<style src="assets/scss/pages/account/edit-account.scss" lang="sass" scoped />

<template>
  <div class="profile__address">
    <div v-if="profile" class="profile__form__body">
      
      <form-text
        v-model="profile.firstname"
        :placeholder="$t('form.first_name')"
        class="form-component"
      >
      </form-text>

      <form-text
        v-model="profile.lastname"
        :placeholder="$t('form.Last_name')"
        class="form-component"
      >
      </form-text>

      <form-text
        v-model="profile.email"
        placeholder="Email"
        required
        class="form-component"
      >
      </form-text>

      <form-text
        v-model="profile.phone"
        :placeholder="$t('form.International_phone')"
        required
        class="form-component"
      >
      </form-text>


      <form-p-c
        :user="profile"
        :errors="errors"
      ></form-p-c>
    </div>

    <div class="profile__form__footer">
        <button @click="changePassHandler" type="button" class="button-only-text">
            <span class="text">{{ $t('button.Change_password') }}</span>
        </button>
        
        <button @click="saveHandler" :class="{loading: isLoading}" class="main-button primary-color small bordered">
            <span class="text">{{ $t('button.save') }}</span>
        </button>
    </div>

  </div>
</template>