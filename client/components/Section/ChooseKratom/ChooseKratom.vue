<script>
export default {
  data() {
    return {
      calc: {
        stimulation: 4,
        relaxation: 5,
        euphoria: 3
      }
    }
  },

  props: {

  },

  computed: {
    effects() {
      return [
        {
          uid: 'stimulation',
          title: this.$t('text.stimulation'),
        },
        {
          uid: 'relaxation',
          title: this.$t('text.relaxation'),
        },
        {
          uid: 'euphoria',
          title: this.$t('text.euphoria'),
        }
      ]
    }
  },

  methods: {

	  loadCalcItems: function(){
		  // var component = this;
		  // component.for_you = [];
		  
		  // axios.post('/catalog/calcRequest', this.calc).then(response => {
			//   console.log(response);
			  
			//   response.data.forEach(function(item){
			// 	  component.for_you.push(item);
			//   });
		  // });
	  },

  	calcMinus: function(param){
	  	if(this.calc[param] > 0)
	  		this.calc[param] -= 0.5;
  	},

  	calcPlus: function(param){
	  	if(this.calc[param] < 5)
	  		this.calc[param] += 0.5;
  	}

  }
}
</script>

<style src="./choose-kratom.scss" lang="sass" scoped />

<template>
  <section class="choose-kratom">
      <div class="choose-kratom__wrapper container">
          
        <div class="choose-kratom__info">
          <h2 class="main-caption">{{ $t('text.choose_kratom_for_yourself') }}</h2>
          <span>{{ $t('text.What_would_you_like?') }}</span>
        </div>

          <div class="choose-kratom__container">
              <div class="choose-kratom__filter">

                <div
                  v-for="effect in effects"
                  :key="effect.uid"
                  class="choose-kratom__filter__item"
                >
                    
                  <p class="caption">{{ effect.title }}</p>

                  <div class="choose-kratom__filter__select">
                    <button @click="calcMinus(effect.uid)" class="choose-kratom__filter__button minus">
                      -
                    </button>
                    
                    <div
                      v-for="circle in 5"
                      :key="circle"
                      :class="{
                        active: calc[effect.uid] > (circle - 0.5),
                        'active-half': calc[effect.uid] == (circle - 0.5)
                      }"
                      class="choose-kratom__point" 
                    >
                      <span class="point-decor__wrapper">
                        <span class="point-decor__inner"></span>
                      </span>
                    </div>
                    
                    <button @click="calcPlus(effect.uid)" class="choose-kratom__filter__button plus">
                      +
                    </button>
                  </div>

                </div>
                
                <button @click="loadCalcItems()" class="main-button-color js-button">
                  <span class="text">{{ $t('text.choose_kratom') }}</span>
                </button>

              </div>

              <div class="choose-kratom__table__wrapper">
                <div class="choose-kratom__table">
                    <div class="choose-kratom__table__grid"></div>
                    <div class="choose-kratom__table__grid"></div>
                    <div class="choose-kratom__table__grid"></div>
                    <div class="choose-kratom__table__grid"></div>
                    <div class="choose-kratom__table__grid"></div>
                    <div :style="{height: (calc.stimulation * 20) + '%'}"  class="choose-kratom__table__point stimulation" >
                        <div class="point"></div>
                    </div>
                    <div :style="{height: (calc.relaxation * 20) + '%'}" class="choose-kratom__table__point relaxation">
                        <div class="point"></div>
                    </div>
                    <div :style="{height: (calc.euphoria * 20) + '%'}" class="choose-kratom__table__point euphoria">
                        <div class="point"></div>
                    </div>
                </div>

                <ul class="choose-kratom__table__list">
                  <li
                    v-for="effect in effects"
                    :key="effect.uid"
                    class="choose-kratom__table__item"
                  >
                    {{ effect.title }}
                  </li>
                </ul>

              </div>

          </div>
      </div>
  </section>
</template>