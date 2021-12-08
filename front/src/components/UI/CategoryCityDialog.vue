<template>
  <teleport to="body">
    <div class="background" @click="$emit('closeCategoryList')"></div>

    <dialog open>
      <slot></slot>
    </dialog>
  </teleport>
</template>

<script>
export default {
  component: {},
  data() {
    return {
      categories: [],
    };
  },
  props: {
    title: {
      type: String,
      required: false,
    },
    mode: {
      type: String,
      required: false,
    },
  },
};
</script>

<style scoped>
.background {
  position: fixed;
  top: 0;
  left: 0;
  height: 100vh;
  width: 100%;
  background-color: rgba(255, 255, 255, 0);
  z-index: 101;
}

dialog {
  position: fixed;
  top: 10vh;
  z-index: 102;
  border: none;
  margin: auto;
  overflow: hidden;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.26);
  border-radius: 15px;
  padding: 1rem;
  text-align: center;
}

h2 {
  font-size: 20px;
  color: var(--main-color);
  margin: 0 0 0.5rem 0;
}
</style>