<template>
  <div
    class="
      dropdown-trigger
      h-dropdown-trigger
      flex
      items-center
      cursor-pointer
      select-none
    "
  >
    <slot />


  </div>
</template>

<script>
export default {
  props: {
    active: {
      type: Boolean,
      default: false,
    },
    showArrow: {
      type: Boolean,
      default: true,
    },
  },

  computed: {
    activeIconColor() {
      return this.active ? 'var(--white)' : 'var(--90)'
    },
  },
}
</script>
