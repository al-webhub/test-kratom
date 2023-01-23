<script>
import { useProductStore } from '~/store/product';

export default {
  setup() {
    const productStore = useProductStore()
    const { t } = useI18n({useScope: 'local'}) 

    return {
      productStore,
      t
    }
  },

  data() {
    return {
      calc: {
        stimulation: 4,
        relaxation: 1,
        euphoria: 3
      }
    }
  },

  computed: {
    effects() {
      return [
        {
          uid: 'stimulation',
          title: this.$t('label.stimulation'),
        },
        {
          uid: 'relaxation',
          title: this.$t('label.relaxation'),
        },
        {
          uid: 'euphoria',
          title: this.$t('label.euphoria'),
        }
      ]
    }
  },

  methods: {
    searchHandler() {
      return this.productStore.toggleModal('chooseKratom')
    },

  	calcMinus (param){
	  	if(this.calc[param] > 0)
	  		this.calc[param] -= 0.5;
  	},

  	calcPlus (param){
	  	if(this.calc[param] < 5)
	  		this.calc[param] += 0.5;
  	}

  }
}
</script>

<style src="./choose-kratom.scss" lang="sass" scoped />

<template>
  <section class="container">
      <div class="wrapper">
          
        <div class="info">
          <h2 class="main-caption">{{ t('choose_kratom_for_yourself') }}</h2>
          <span>{{ t('What_would_you_like?') }}</span>
        </div>

          <div class="box">
              <div class="controls">

                <div
                  v-for="effect in effects"
                  :key="effect.uid"
                  class="controls__item"
                >  
                  <p class="caption">{{ effect.title }}</p>
                  <simple-five-dots v-model="calc[effect.uid]"></simple-five-dots>
                </div>
                
                <button @click="searchHandler()" class="main-button primary">
                  <span class="text">{{ $t('button.choose_kratom') }}</span>
                </button>

              </div>

              <div class="graph__wrapper">
                <div class="graph">
                    <div class="graph__grid"></div>
                    <div class="graph__grid"></div>
                    <div class="graph__grid"></div>
                    <div class="graph__grid"></div>
                    <div class="graph__grid"></div>
                    <div :style="{height: (calc.stimulation * 20) + '%'}"  class="graph__point stimulation" >
                        <div class="point"></div>
                    </div>
                    <div :style="{height: (calc.relaxation * 20) + '%'}" class="graph__point relaxation">
                        <div class="point"></div>
                    </div>
                    <div :style="{height: (calc.euphoria * 20) + '%'}" class="graph__point euphoria">
                        <div class="point"></div>
                    </div>
                </div>

                <ul class="graph__list">
                  <li
                    v-for="effect in effects"
                    :key="effect.uid"
                    class="graph__item"
                  >
                    {{ effect.title }}
                  </li>
                </ul>

              </div>

          </div>
      </div>
  </section>
</template>


<i18n>
  {
    "en": {
      "choose_kratom_for_yourself": "choose kratom for yourself",
      "What_would_you_like?": "What would you like?",
    },
    "ru": {
      "choose_kratom_for_yourself": "выберите кратом для себя",
      "What_would_you_like?": "Что вам нравится?",
    }
  }
</i18n>