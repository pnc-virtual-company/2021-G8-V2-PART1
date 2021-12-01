<template>
  <section>
    <form>
      <h2>SIGN IN HERE</h2>
      <div>
        <input type="email" placeholder="Email" v-model="email" />
        <div class="error" v-if="emailError">
          <p v-text="emailError"></p>
        </div>
      </div>
      <div>
        <input type="password" placeholder="Password" v-model="password" />
        <div class="error" v-if="passwordError">
          <p v-text="passwordError"></p>
        </div>
      </div>
      <router-link to="/signup">Create an account?</router-link>

      <div class="serverMessage" v-if="unauthorizedError">
        <p v-text="unauthorizedError"></p>
      </div>
      <div :class="isValidated ? 'buttonActive' : 'buttonInactive'">
        <button type="button" id="registerOrSignin" @click="emitUserData">Sign in</button>
      </div>
    </form>
  </section>
</template>

<script>
export default {
  emit: ['emitUserData'],
  props: ['unauthorizedError'],
  data() {
    return {
      userData: {},
      email: "",
      password: "",
      isActivateButton: 0,

      emailError: "invalid email",
      passwordError: "password must be at least 8 characters",
    };
  },
  watch: {
    email: function(value) {
      const emailRegex = RegExp(
        /^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/
      );
      if(emailRegex.test(value)) {
        this.emailError = '';
      } else {
        this.emailError = 'invalid email';
      }
    },
    password: function(value) {
      if(value.length >= 8) {
        this.passwordError = '';
      } else {
        this.passwordError = "password must be at least 8 characters";
      }
    },
  },
  computed: {
    isValidated() {
      let isOkay = this.emailError === '' && this.passwordError === '';
      if(isOkay) {
        return 1;
      }
      return 0;
    }
  },
  methods: {
    emitUserData() {
      if(this.isValidated) {
        let userData = {
          email: this.email,
          password: this.password,
        };
        this.$emit('signin', userData);
      }
    }
  },
  provide() {
    return {userData: this.userData};
  }
};
</script>