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
      gap: 30,
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
    perPage() {
      if(this.$device.isDesktop)
        return 4;

      if(this.$device.isTablet)
        return 2
      
      return 1;
    },

    listStyleValue() {
      return {
        transform: `translateX(${this.offset}px)`
      }
    },

    slides() {
      return this.values
    },

    cardWidth() {
      if(this.$refs?.card && this.$refs?.card[0])
        return this.$refs?.card[0].offsetWidth
      else
        return 0
    }
  },

  methods: {
    prevHandler(){
      const cardWidth = this.$refs?.card[0].offsetWidth + this.gap
      const maxWidth = (this.arrayLength - this.perPage) * cardWidth * -1;

      if(this.offset < 0) {
        this.offset = this.offset + cardWidth
        this.activeIndex--
      }else {
        this.offset = maxWidth
        this.activeIndex = this.arrayLength - 1
      }
    },

    nextHandler() {
      const cardWidth = this.$refs?.card[0].offsetWidth + this.gap
      const maxWidth = (this.arrayLength - this.perPage) * cardWidth * -1;

      if(this.offset > maxWidth){
        this.offset = this.offset - cardWidth
        this.activeIndex++
      }else {
        this.offset = 0
        this.activeIndex = 0
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
    >
      <ul :style="listStyleValue" class="list-ul">
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
      @prev="prevHandler"
      @next="nextHandler"
    >
    </simple-slider-btns>
  </div>
</template>