<script>
export default {

  setup (props){
    let targetComponent = null

    switch (props.targetComponentName) {
      case 'reviewHomeCard':
        targetComponent = resolveComponent('reviewHomeCard')
        break;
      case 'productCard':
        targetComponent = resolveComponent('productCard')
        break;
    }

    return {
      targetComponent
    }
  },

  data() {
    return {
      activeIndex: 0,
      arrayLength: 0,
      offset: 0,
      gap: 20,
      isMounted: false,
      touch: {
        from: null,
        to: null
      }
    }
  },
  
  props: {
    values: {
      type: Array,
      required: true
    },
    allItemsLabel: {
      type: String
    },
    allItemsLink: {
      type: String
    },
    targetComponentName: {
      type: String
    },
    targetDataName: {
      type: String
    },
    initOn: {
      type: String,
      default: 'tablet'
    }
  },

  computed: {

    listStyleValue() {
      return {
        transform: `translateX(${this.offset}px)`
      }
    },

    slides() {
      return this.values
    },

    // cardWidth() {
    //   if(this.$refs?.card && this.$refs?.card[0])
    //     return this.$refs?.card[0].offsetWidth
    //   else
    //     return 0
    // },

    isOffset() {
      if(this.isMounted) {
        //let cardWidth = this.$refs.card[0].offsetWidth + this.gap
        let cardWidth = 300 + this.gap
        // console.log('isMounted', this.$refs.card[0].offsetWidth, cardWidth, this.arrayLength, this.gap,  (cardWidth * this.arrayLength), window.innerWidth )
        return (cardWidth * this.arrayLength - window.innerWidth) > 0
      }
      else
        return false
    }
  },

  methods: {

    prevHandler(){
      const cardWidth = this.$refs?.card[0].offsetWidth + this.gap
      const maxOffset = (cardWidth * this.arrayLength - window.innerWidth) * -1
      const emptySpace = Math.abs(this.offset)

      if(emptySpace >= cardWidth) {
        this.offset = this.offset + cardWidth
        this.activeIndex--
      } else if(emptySpace === 0) {
        this.offset = maxOffset - this.gap
        this.activeIndex = this.arrayLength - 1
      } else {
        this.offset = this.offset + emptySpace
        this.activeIndex--
      }
    },

    nextHandler() {
      const cardWidth = this.$refs?.card[0].offsetWidth + this.gap
      const maxOffset = (cardWidth * this.arrayLength - window.innerWidth) * -1
      const emptySpace = Math.abs(maxOffset - this.offset - this.gap)

      if(emptySpace >= cardWidth) {
        this.offset = this.offset - cardWidth
        this.activeIndex++
      } else if(emptySpace === 0) {
        this.offset = 0
        this.activeIndex = 0
      } else {
        this.offset = this.offset - emptySpace
        this.activeIndex++
      }
    },

    touchHandler(event) {
      //console.log('TOUCH', event)
    },

    touchStartHandler(event) {
      this.touch.from = event.changedTouches[0].screenX
    },

    touchEndHandler(event) {
      this.touch.to = event.changedTouches[0].screenX

      const step = this.touch.from - this.touch.to
      
      if(Math.abs(step) < 30)
        return

      if(step < 0)
        this.prevHandler()
      else
        this.nextHandler()
    },
  },

  mounted() {
    this.arrayLength = this.values.length
    this.isMounted = true
  }
}
</script>

<style src="./slider.scss" lang="scss" scoped />

<template>
  <div>
    <div class="list"
      @touchmove="touchHandler"
      @touchstart="touchStartHandler"
      @touchend="touchEndHandler"
      :class="initOn"
      ref="wrapper"
      scrollable
    >
      <ul :style="listStyleValue" class="list-ul" ref="list">
        <li
          v-for="(item, index) in slides"
          :key="item.id"
          class="item"
          ref="card"
        >
          <component :is="targetComponent" :[targetDataName]="item"></component>
        </li>
      </ul>
    </div>

    <simple-slider-btns
      :title="allItemsLabel"
      :items="slides.length"
      :link="allItemsLink"
      :active-index="activeIndex"
      :is-arrows="isOffset"
      @prev="prevHandler"
      @next="nextHandler"
    >
    </simple-slider-btns>
  </div>
</template>