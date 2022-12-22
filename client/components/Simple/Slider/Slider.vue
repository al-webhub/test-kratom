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
      items: [],
      arrayLength: 0,
      cardHeight: 0,
      startIndex: 0,
      direction: 'next',
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
        height: this.cardHeight
      }
    }
  },

  methods: {
    prevHandler(){
      this.direction = 'prev'
      let index = this.arrayLength - 1

      let item = this.items.splice(index, 1)
      this.items.unshift(item[0])
    },

    nextHandler() {
      this.direction = 'next'
      let index = 0
      let item = this.items.splice(index, 1)
      this.items.push(item[0])
    },

    touchHandler(event) {
      console.log('TOUCH', event)
    },

    touchStartHandler(event) {
      this.touch.from = event.changedTouches[0].screenX
    },

    touchEndHandler(event) {
      this.touch.to = event.changedTouches[0].screenX

      if(this.touch.from < this.touch.to) {
        this.prevHandler()
      }else
      {
        this.nextHandler()
      }
    },

    heightHandler(value) {
      this.cardHeight = value
    },
  },

  mounted() {
    this.startIndex = 0
    this.arrayLength = this.values.length
    this.items = this.values
  }
}
</script>

<style src="./slider.scss" lang="scss" scoped />

<style lang="scss">
.list-ul{
  position: relative;
  display: grid;
  grid-template-columns: repeat(1, 1fr);
  grid-gap: 30px;

  @media (min-width: 768px) {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
  }

  @media (min-width: 1024px) {
    display: block;
  }
}
</style>

<template>
  <div class="list"
    @touchmove="touchHandler"
    @touchstart="touchStartHandler"
    @touchend="touchEndHandler"
    :style="listStyleValue"
    :class="initOn"
  >
    <TransitionGroup name="list" tag="ul" class="list-ul"  mode="in-out" appear>
      <li
        v-for="(item, index) in items"
        :key="item.id"
        :class="[{show:  index === startIndex }, direction, 'item-' + index]"
        class="item"
        ref="card"
      >
        <component :is="targetComponent" :[targetDataName]="item" @height="heightHandler"></component>
        <!-- <review-home-card :review="review"></review-home-card> -->
      </li>
    </TransitionGroup>
  </div>

  <simple-slider-btns
    :title="allItemsLabel"
    :items="values.length"
    :link="allItemsLink"
    @prev="prevHandler"
    @next="nextHandler"
  >
  </simple-slider-btns>
</template>