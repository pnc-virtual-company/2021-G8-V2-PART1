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
        <button type="button" id="signIn" @click="emitUserData">Sign in</button>
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
      return this.emailError === '' && this.passwordError === '';
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
  mounted() {
    window.onpopstate = () => {
      if (
        localStorage.getItem("userID") === null &&
        (this.$route.path === "/event" ||
        this.$route.path === "/myEvent" ||
        this.$route.path === "/categoryView")
      ) {
        this.$router.push("/signin");
      }
    }
    if(localStorage.userID) {
      this.$router.push('/event');
    }
  },
};
</script>
<style scoped>
form input,
a,
form button {
  margin-bottom: 10px;
  font-size: 17px;
  cursor: pointer;
}
form {
  margin: auto;
  width: 300px;
  padding: 30px;
  background: #ffffff;
  box-shadow: inset 0px 4px 4px rgba(0, 0, 0, 0.25);
  border-radius: 15px;
  margin-bottom: 50px;
}
form .buttonInactive,
form .buttonActive {
  text-align: right;
  margin: 5px 0;
}
form button {
  width: 90px;
  height: 30px;
  color: white;
  border: none;
  border-radius: 15px;
}
form .buttonActive button {
  background: var(--main-color);
}
form .buttonInactive button {
  background: grey;
}
form .buttonActive #signIn:hover {
  color: rgb(173, 101, 233);
  border: 1px solid rgb(173, 101, 233);
}
form input {
  width: 100%;
  box-sizing: border-box;
  background: #fffdfd;
  box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
  border-radius: 5px;
  border: none;
  height: 30px;
  padding: 2px 10px;
  outline: none;
}
form input:focus {
  border: 1px solid var(--main-color);
}
form h2 {
  text-align: center;
  margin-bottom: 5px;
}
form a {
  margin-bottom: 5px;
}
.error,
.serverMessage {
  color: rgb(255, 97, 97);
  margin: 5px 0;
  font-size: 12px;
}
.serverMessage {
  text-align: center;
}
</style>