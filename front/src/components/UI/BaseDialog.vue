<template>
  <teleport to='body'>
    <div class="background" @click="$emit('close')"></div>
    <dialog open>
      <form>
        
        <h2>{{ title }}</h2>
       
        <section>
          <slot></slot>
        </section>
        <menu>
          <slot name="actions">
          </slot>
        </menu>
      </form>
    </dialog>
  </teleport>
</template>

<script>
export default {
  props: {
    title: {
      type: String,
      required: false,
    },
    mode: {
      type: String,
      required: false
    }
  },
  emits: ['close'],
};
</script>

<style scoped>
.background {
  position: fixed;
  top: 0;
  left: 0;
  height: 100vh;
  width: 100%;
  background-color: rgba(0, 0, 0, 0.75);
  z-index: 10;
}

dialog {
  position: fixed;
  top: 10vh;
  z-index: 100;
  border: none;
  margin: auto;
  overflow: hidden;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.26);
  border-radius: 15px;
  padding: 1rem;
  text-align: center;
}

menu {
  padding: 1rem;
  display: flex;
  justify-content: flex-end;
  margin: 0;
}

h2 {
  font-size: 20px;
  color: var(--main-color);
  margin: 0 0 0.5rem 0;
}
</style>