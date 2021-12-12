<template>
  <button type="button">
    <slot></slot>
  </button>
</template>

<script>
export default {
};
</script>

<style scoped>
button {
  text-decoration: none;
  width: 80px;
  padding: 8px 12px;
  margin: 8px;
  border-radius: 50px;
  border: none;
  cursor: pointer;

  background-color: rgb(255, 50, 50);
  color: white;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.26);
}
.buttonActive:hover {
  color: rgb(173, 101, 233);
}
.buttonActive {
  background: var(--main-color);
}
.buttonInactive {
    background: rgba(128, 128, 128, 0.219);
    color: rgba(128, 128, 128, 0.445);
}
</style>