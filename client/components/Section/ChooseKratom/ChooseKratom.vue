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

                  <div class="choose-kratom__filter__item">
                      
                    <p class="caption">{{ $t('text.stimulation') }}</p>

                    <div class="choose-kratom__filter__select">
                      <button @click="calcMinus('stimulation')" class="choose-kratom__filter__button">
                          <span class="icon-minus"></span>
                      </button>
                      
                      <div
                        v-for="circle in 5"
                        :key="circle"
                        :class="{
                          active: calc.stimulation > (circle - 0.5),
                          'active-half': calc.stimulation == (circle - 0.5)
                        }"
                        class="choose-kratom__point" 
                      >
                          <span class="point-decor__wrapper">
                              <span class="point-decor__inner"></span>
                          </span>
                      </div>
                      
                      <button @click="calcPlus('stimulation')" class="choose-kratom__filter__button">
                        <span class="icon-plus"></span>
                      </button>
                    </div>

                  </div>

                  <div class="choose-kratom__filter__item">
                      <p class="caption">{{ $t('text.relaxation') }}</p>
                      <div class="choose-kratom__filter__select">
                          <button class="choose-kratom__filter__button" @click="calcMinus('relaxation')">
                              <span class="icon-minus"></span>
                          </button>
                          
                          <div
                            v-for="circle in 5"
                            :key="circle"
                            :class="{
                              active: calc.relaxation > (circle - 0.5),
                              'active-half': calc.relaxation == (circle - 0.5)
                            }"
                            class="choose-kratom__point"
                          >
                              <span class="point-decor__wrapper">
                                  <span class="point-decor__inner"></span>
                              </span>
                          </div>
                          
                          <button class="choose-kratom__filter__button" @click="calcPlus('relaxation')">
                              <span class="icon-plus"></span>
                          </button>
                      </div>
                  </div>

                  <div class="choose-kratom__filter__item">
                      <p class="caption">{{ $t('text.euphoria') }}</p>
                      <div class="choose-kratom__filter__select">
                          <button class="choose-kratom__filter__button" @click="calcMinus('euphoria')">
                              <span class="icon-minus"></span>
                          </button>
                          <div
                            v-for="circle in 5" 
                            :key="circle"
                            :class="{
                              active: calc.euphoria > (circle - 0.5),
                              'active-half': calc.euphoria == (circle - 0.5)
                            }"
                            class="choose-kratom__point"
                            >
                              <span class="point-decor__wrapper">
                                  <span class="point-decor__inner"></span>
                              </span>
                          </div>
                          <button class="choose-kratom__filter__button" @click="calcPlus('euphoria')">
                              <span class="icon-plus"></span>
                          </button>
                      </div>
                  </div>
                  
                  <button class="main-button-color js-button" data-target="result-calc" @click="loadCalcItems()">
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
                      <li class="choose-kratom__table__item">{{ $t('text.stimulation') }}</li>
                      <li class="choose-kratom__table__item">{{ $t('text.relaxation') }}</li>
                      <li class="choose-kratom__table__item">{{ $t('text.euphoria') }}</li>
                  </ul>

              </div>

          </div>
      </div>
  </section>
</template>