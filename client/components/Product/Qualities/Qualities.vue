<script>
export default {
  props: {
    stimulation: {
      type: Number
    },
    relaxation: {
      type: Number
    },
    euphoria: {
      type: Number
    }
  },

  methods: {
    updateStimulationHandler(value) {
      this.$emit('update:stimulation', value)
    },
    updateRelaxationHandler(value) {
      this.$emit('update:relaxation', value)
    },
    updateEuphoriaHandler(value) {
      this.$emit('update:euphoria', value)
    }
  }
}
</script>

<style src="./qualities.scss" lang="sass" scoped />

<template>
  <div 
    v-if="stimulation != null && relaxation != null && euphoria != null" 
    class="choose-kratom__filter"
  >
    <div class="choose-kratom__filter__item"> 
      <p class="caption">{{ $t('text.stimulation') }}</p>
      <simple-five-dots
        :model-value="stimulation"
        @update:modelValue="updateStimulationHandler"
        size="medium"
      >
      </simple-five-dots>
    </div>
    
    <div class="choose-kratom__filter__item">
      <p class="caption">{{ $t('text.relaxation') }}</p>
      <simple-five-dots
        :model-value="relaxation"
        @update:modelValue="updateRelaxationHandler"
        size="medium"
      >
      </simple-five-dots>
    </div>

    <div class="choose-kratom__filter__item">
      <p class="caption">{{ $t('text.euphoria') }}</p>
      <simple-five-dots
        :model-value="euphoria"
        @update:modelValue="updateEuphoriaHandler"
        size="medium"
      >
      </simple-five-dots>
    </div>
  </div>

  <div
    class="product-page__info-text"
    v-if="stimulation !== null && relaxation !== null && euphoria !== null"
  >
    <p>{{ $t('text.Users_take') }}</p>
    <p>{{ $t('text.As_soon_as') }}</p>
  </div>
</template>