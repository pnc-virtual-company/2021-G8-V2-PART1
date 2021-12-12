<template>
  <section>
    <form>
      <h2>REGISTER HERE</h2>
      <div>
        <input type="text" placeholder="First Name" v-model="firstName" />
        <div class="error" v-if="firstnameError">
          <p v-text="firstnameError"></p>
        </div>
      </div>
      <div>
        <input type="text" placeholder="Last Name" v-model="lastName" />
        <div class="error" v-if="lastnameError">
          <p v-text="lastnameError"></p>
        </div>
      </div>
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
      <div>
        <input
          type="password"
          placeholder="Confirm Password"
          v-model="confirmPassword"
        />
        <div class="error" v-if="cPasswordError">
          <p v-text="cPasswordError"></p>
        </div>
      </div>
      <router-link to="signin">Have an account?</router-link>

      <div class="serverMessage" v-if="existedEmailError">
        <p v-text="existedEmailError"></p>
      </div>
      <div :class="isValidated ? 'buttonActive' : 'buttonInactive'">
        <button type="button" id="register" @click="emitNewUserData">
          Register
        </button>
      </div>
    </form>
  </section>
</template>

<script>
export default {
  emit: ["emitNewUserData"],
  props: ["existedEmailError"],
  data() {
    return {
      firstName: "",
      lastName: "",
      email: "",
      password: "",
      confirmPassword: "",

      firstnameError: "",
      lastnameError: "",
      emailError: "",
      passwordError: "",
      cPasswordError: "",
    };
  },
  watch: {
    firstName: function (value) {
      if (value !== "") {
        this.firstnameError = "";
      } else {
        this.firstnameError = "require firstname";
      }
    },
    lastName: function (value) {
      if (value !== "") {
        this.lastnameError = "";
      } else {
        this.lastnameError = "require lastname";
      }
    },
    email: function (value) {
      const emailRegex = RegExp(
        /^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/
      );
      if (emailRegex.test(value)) {
        this.emailError = "";
      } else {
        this.emailError = "invalid email";
      }
    },
    password: function (value) {
      if (value.length >= 8) {
        this.passwordError = "";
        if (this.confirmPassword === this.password) {
          this.cPasswordError = "";
        }
      } else {
        this.passwordError = "password must be at least 8 characters";
        this.cPasswordError = "confirm password isn't matched";
      }
    },
    confirmPassword: function (value) {
      if (this.passwordError === "" && value === this.password) {
        this.cPasswordError = "";
      } else {
        this.cPasswordError = "confirm password isn't matched";
      }
    },
  },
  computed: {
    isValidated() {
      return (
        this.firstnameError === "" &&
        this.lastnameError === "" &&
        this.emailError === "" &&
        this.passwordError === "" &&
        this.cPasswordError === "" &&
        this.firstName !== "" &&
        this.lastName !== "" &&
        this.email !== "" &&
        this.password !== "" &&
        this.confirmPassword !== ""
      );
    },
  },
  methods: {
    emitNewUserData() {
      if (this.isValidated) {
        let newUserData = {
          firstname: this.firstName,
          lastname: this.lastName,
          email: this.email,
          password: this.password,
          password_confirmation: this.confirmPassword,
        };
        this.$emit("register", newUserData);
      }
    },
  },
  mounted() {
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
form #register {
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
  background: rgba(128, 128, 128, 0.219);
  color: rgba(128, 128, 128, 0.445);
}
form .buttonActive #register:hover {
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
