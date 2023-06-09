<script setup>
  import { useProductStore } from '~/store/product';
  import { useQualitiesStore } from '~/store/qualities';

  const { t } = useI18n({useScope: 'local'})

  const props = defineProps({
    product: {
      type: Object
    }
  })

  // COMPUTED
  const stimulation = computed(() => {
    const attr = props.product.attrs.find(item => item.slug === 'stimulation')
    return attr?.value && toHumanValue(attr.value) || null
  })

  const relaxation = computed(() => {
    const attr = props.product.attrs.find(item => item.slug === 'relaxation')
    return attr?.value && toHumanValue(attr.value) || null
  })

  const euphoria = computed(() => {
    const attr = props.product.attrs.find(item => item.slug === 'euphoria')
    return attr?.value && toHumanValue(attr.value) || null
  })

  const userMarks = computed(() => {
    return useQualitiesStore().getMarks(props.product.id) || {}
  })

  // METHODS
  const toHumanValue = (x) => {
    return Math.floor(x / 20 * 2) / 2
  }

  // HANDLERS
  const updateQualityHandler = (name,value) => {
    useQualitiesStore().setMark(props.product.id, name, value)
    useProductStore().updateQualities(props.product.id, {[name]: value})
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
          :user-mark="userMarks['stimulation']"
          @update:modelValue="(value) => updateQualityHandler('stimulation', value)"
          get="relative"
          size="medium"
        >
        </simple-five-dots>
      </div>
      
      <div class="item">
        <p class="caption">{{ $t('label.relaxation') }}</p>
        <div class="line"></div>
        <simple-five-dots
          :model-value="relaxation"
          :user-mark="userMarks['relaxation']"
          @update:modelValue="(value) => updateQualityHandler('relaxation', value)"
          get="relative"
          size="medium"
        >
        </simple-five-dots>
      </div>

      <div class="item">
        <p class="caption">{{ $t('label.euphoria') }}</p>
        <div class="line"></div>
        <simple-five-dots
          :model-value="euphoria"
          :user-mark="userMarks['euphoria']"
          @update:modelValue="(value) => updateQualityHandler('euphoria', value)"
          get="relative"
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