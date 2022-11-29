<script>
export default {
  data() {
    return {
      calc: {
        stimulation: 4,
        relaxation: 1,
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
  <section class="container">
      <div class="wrapper">
          
        <div class="info">
          <h2 class="main-caption">{{ $t('text.choose_kratom_for_yourself') }}</h2>
          <span>{{ $t('text.What_would_you_like?') }}</span>
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
                
                <button @click="loadCalcItems()" class="main-button-color">
                  <span class="text">{{ $t('text.choose_kratom') }}</span>
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