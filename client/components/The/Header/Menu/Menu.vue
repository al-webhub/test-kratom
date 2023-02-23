<script setup>
  import _merge from 'lodash.merge'

  const menuObservedVisible = ref({})

  // COMPUTED
  const isMenuObserved = computed(() => {
    if(!menu.value)
      return false

    const carry = Object.keys(menu.value).reduce((carry, key) => {
      return carry + menu.value[key].observed
    }, 0)

    return  carry === Object.keys(menu.value).length
  })

  const baseMenu = computed(() => {
    return useMenu().menu
  })

  const menu = computed(() => {
      // Set Base menu items from composables
      let menu = _merge(baseMenu.value, menuObservedVisible.value)

      // Set product categories to submenu
      const groups = useProductGroups()
      const productGroups = groups.reduce((carry, item) => carry.concat(item.items), [])
      menu.shop.items = productGroups

      return menu
  })

  const menuGroups = computed(() => {
    const groups = {
      visible: {},
      invisible: {}
    }

    Object.keys(menu.value).forEach((key) => {
      if(menu.value[key].visible === true)
        groups.visible[key] = menu.value[key]
      else
        groups.invisible[key] = menu.value[key]
    })

    return groups
  })

  //METHODS
  const observeCallback = (index, visible) => {
    menuObservedVisible.value[index].observed = true
    menuObservedVisible.value[index].visible = visible
  }


  const setMenuObservedVisible = () => {
    Object.keys(baseMenu.value).forEach(key => {
      menuObservedVisible.value[key] = {
        observed: false,
        visible: true
      }
    })
  }

  // HOOKS
  setMenuObservedVisible()
</script>

<style src="./menu.scss" lang="sass" scoped />

<template>
  <nav :class="{overflow: isMenuObserved}" class="nav">
    <span class="general-decor-elem"></span>

    <ul class="list">
        <li
          v-for="(item, key) in menuGroups.visible"
          :key="item.id"
          v-observe="{index: key, callback: observeCallback}"
          class="item"
        >
            <NuxtLink
              :to="localePath(item.link)"
              :prefetch="false"
              class="link"
            >
              {{ item.name }}
            </NuxtLink>

            <img v-if="item.items && item.items.length" src="~assets/svg-icons/arrow-simple.svg" class="icon" />

            <ul v-if="item.items && item.items.length" class="submenu">
              <li v-for="subitem in item.items" :key="subitem.id" class="submenu-item">
                <NuxtLink :to="localePath(subitem.link)" :prefetch="false" class="submenu-link">
                  {{ subitem.name }}
                </NuxtLink>
              </li>
            </ul>
        </li>

        <li v-if="menuGroups.invisible && Object.keys(menuGroups.invisible).length !== 0" class="item">
          <span class="link">{{ $t('title.menu') }}</span>
          <img src="~assets/svg-icons/arrow-simple.svg" class="icon" />

          <ul class="submenu">
            <li
              v-for="(item, key) in menuGroups.invisible"
              :key="key"
              class="submenu-item"
            >
              <NuxtLink :to="localePath(item.link)" :prefetch="false" class="submenu-link">
                {{ item.name }}
              </NuxtLink>
            </li>
          </ul>
        </li>
    </ul>
  </nav>
</template>