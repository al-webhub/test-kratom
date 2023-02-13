<script setup>
  const props = defineProps({
    modelValue: {
      type: String
    },

    user: {
      type: Object
    }
  })

  const emit = defineEmits([
    'update:modelValue'
  ])

  // COMPUTED
  const photo = computed(() => {
    if(props?.user?.photo)
      return props?.user?.photo.startsWith('http')? props?.user?.photo: '/server/' + props?.user?.photo
    else
      return '/images/photo-log-in.png'
  })

  // HANDLERS
  const updateHandler = (value) => {
    emit('update:modelValue', value)
  }
</script>


<style src="./input.scss" lang="scss" scoped />

<template>
  <div class="wrapper">

    <nuxt-img
      v-if="photo"
      :src = "photo"
      alt="You avatar"
      sizes = "mobile:40px"
      width="40"
      height="40"
      format = "webp"
      quality = "40"
      loading = "lazy"
      fit="cover"
      class="avatar">
    >
    </nuxt-img>
    
    <!-- textarea -->
    <form-textarea
      :model-value="modelValue"
      @update:modelValue="updateHandler"
      :placeholder="$t('form.your_review')"
    >
    </form-textarea>

  </div>
</template>