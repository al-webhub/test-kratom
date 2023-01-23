<script>
export default {
  setup() {
    const { t } = useI18n({useScope: 'local'})
    return {t}
  },

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
    class="box"
  >

    <div class="qualities">

      <p class="qualities-caption">{{ $t('label.characteristic') }}:</p>

      <div class="item"> 
        <p class="caption">{{ $t('label.stimulation') }}</p>
        <div class="line"></div>
        <simple-five-dots
          :model-value="stimulation"
          @update:modelValue="updateStimulationHandler"
          size="medium"
        >
        </simple-five-dots>
      </div>
      
      <div class="item">
        <p class="caption">{{ $t('label.relaxation') }}</p>
        <div class="line"></div>
        <simple-five-dots
          :model-value="relaxation"
          @update:modelValue="updateRelaxationHandler"
          size="medium"
        >
        </simple-five-dots>
      </div>

      <div class="item">
        <p class="caption">{{ $t('label.euphoria') }}</p>
        <div class="line"></div>
        <simple-five-dots
          :model-value="euphoria"
          @update:modelValue="updateEuphoriaHandler"
          size="medium"
        >
        </simple-five-dots>
      </div>
    </div>

    <div
      v-if="stimulation !== null && relaxation !== null && euphoria !== null"
      class="info"
    >
      <p>{{ t('Users_take') }}</p>
      <p>{{ t('As_soon_as') }}</p>
    </div>
  </div>
</template>
<i18n>
  {
    en: {
      "Users_take" : "Users take part in creating a rating of characteristics",
      "As_soon_as" : "As soon as 10 people choose the +/-  sign in relation to an individual characteristic - it will be changed",
    },

    ru: {
      Users_take: "Пользователи принимают участие в создании рейтинга характеристик",
      As_soon_as: "Как только 10 человек выберут знак +/- по отношению к индивидуальной характеристике - он будет изменен",
    }
  }
</i18n>