<script>
import { useProfileStore } from '~/store/profile';
import { useAuthStore } from '~/store/auth';
import { useModalStore } from '~/store/modal';

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
      isLoading: false,
      errors: {}
    }
  },


  computed: {
    profile() {
      return this.profileStore?.profile;
    },
    user() {
      return this.authStore?.getUser;
    }
  },

  methods: {
    setCrumbs() {
      useCrumbs().setCrumbs([
          {
            name: this.$t('crumbs.home'),
            item: '/'
          },{
            name: this.$t('crumbs.account'),
            item: '/account/order-history'
          },{
            name: this.$t('crumbs.edit_account'),
            item: '/account/edit_account'
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
        })
        .finally(() => {
          this.isLoading = false
        })
    },

    resetPassHandler() {
      useModalStore().setData('resetPassword', this.user?.email)
      useModalStore().open('resetPassword')
    }
  },

  created() {
    this.setCrumbs()
  }
}
</script>

<style src="./edit-account.scss" lang="sass" scoped />

<template>
  <div class="profile__address">
    <div v-if="profile" class="profile__form__body">
      
      <form-text
        v-model="profile.firstname"
        :placeholder="$t('form.first_name')"
        :error="errors?.firstname"
        class="form-component"
      >
      </form-text>

      <form-text
        v-model="profile.lastname"
        :placeholder="$t('form.Last_name')"
        :error="errors?.lastname"
        class="form-component"
      >
      </form-text>

      <form-text
        v-model="profile.email"
        :error="errors?.email"
        placeholder="Email"
        required
        class="form-component"
      >
      </form-text>

      <form-text
        v-model="profile.phone"
        :error="errors?.phone"
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
        <button @click="resetPassHandler" clickable type="button" class="button-only-text">
            <span class="text">{{ $t('button.Change_password') }}</span>
        </button>
        
        <button @click="saveHandler" :class="{loading: isLoading}" clickable class="main-button primary-color small bordered">
            <span class="text">{{ $t('button.save') }}</span>
        </button>
    </div>

  </div>
</template>