<template>
  <div class="login">
    <template v-if="!isLoggedIn">
      <h1>Login</h1>
      <form @submit.prevent="login">
        <ul>
          <li>
            <label for="email">email :
              <input id="email" v-model="item.email" type="email" required>
            </label>
          </li>
          <li>
            <label for="password">password :
              <input id="password" v-model="item.password" type="password" required>
            </label>
          </li>
          <li>
            <label for="submit">
              <input id="submit" type="submit" value="Login">
            </label>
          </li>
        </ul>
      </form>
    </template>

    <template v-else>
      <h1>YOU ARE LOGGED INNNNNN!!!</h1>
      <button @click="logout">Logout</button>
    </template>

  </div>
</template>

<script>
export default {
  data() {
    return {
      item: {
        email: '',
        password: '',
      }
    }
  },
  computed: {
    isLoggedIn() {
      return this.$store.getters["auth/isLoggedIn"]
    }
  },
  methods: {
    login: async function () {
      await this.$store.dispatch('auth/login', this.item)
      alert('Login succeeded.')
    },
    logout: function () {
      this.$store.dispatch('auth/logout')
      alert('Logout succeeded.')
    }
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
h3 {
  margin: 40px 0 0;
}

ul {
  list-style-type: none;
  padding: 0;
}

li {
  margin: 0 10px;
}

a {
  color: #42b983;
}
</style>
