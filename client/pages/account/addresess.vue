<script>
definePageMeta({
  layout: "account",
});

export default {

  layout: 'account',

  data(){
    return {
      user: {
        usermeta: {
          address_details: {
            is_default: true,
            country: null,
            street: null,
            apartment: null,
            city: null,
            state: null,
            zip: null,
            comment: null
          }
        }
      }
    }
  },
}
</script>

<style src="assets/scss/pages/account/addresess.scss" lang="sass" scoped />

<template>
  <div class="profile__address">
    <div class="profile__form__body">

      <form-checkbox
        v-model="user.usermeta.address_details.is_default"
        :label="$t('text.Use_the_addresses')"
        class="form-component input__wrapper100"
      >
      </form-checkbox>

      <form-select
        v-model="user.usermeta.address_details.country"
        :placeholder="$t('text.Country_Region')"
        :values="['Ukraine', 'Russia']"
        class="form-component"
      >
      </form-select>

      <form-text
        v-model="user.usermeta.address_details.street"
        :placeholder="$t('text.Street_Number')"
        class="form-component"
      >
      </form-text>

      <form-text
        v-model="user.usermeta.address_details.apartment"
        :placeholder="$t('text.Apartment_house_flat')"
        class="form-component"
      >
      </form-text>

      <form-text
        v-model="user.usermeta.address_details.city"
        :placeholder="$t('text.Town_City')"
        class="form-component"
      >
      </form-text>

      <form-text
        v-model="user.usermeta.address_details.state"
        :placeholder="$t('text.State')"
        class="form-component"
      >
      </form-text>

      <form-text
        v-model="user.usermeta.address_details.zip"
        :placeholder="$t('text.ZIP')"
        class="form-component"
      >
      </form-text>

      <form-textarea
        v-model="user.usermeta.address_details.comment"
        :placeholder="$t('text.Specify_or_write')"
        class="form-component input__wrapper100"
      >
      </form-textarea>
      
    </div>
    
    <div class="profile__form__footer">
      <button class="main-button main-button-small main-button-profile">
        <span class="text">{{ $t('text.save_address') }}</span>
      </button>
    </div>

  </div>
</template>