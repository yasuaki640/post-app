<template>
  <div id="nav">

    <router-link to="/">Login</router-link>

    <template v-if="isLoggedIn">
      <router-link to="/edit-profile">Edit profile</router-link>
      <router-link to="/list-post">List Post</router-link>
      <router-link :to="{ path: 'create-post'}">Create post</router-link>
    </template>

    <template v-else>
      <router-link to="/sign-up">Sign up</router-link>
    </template>

    <router-view/>
  </div>
</template>

<style>

#nav {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  padding: 30px;
  text-align: center;
  color: #2c3e50;
}

#nav a {
  margin: 0.8rem;
  font-weight: bold;
  color: #2c3e50;
}

#nav a.router-link-exact-active {
  color: #42b983;
}
</style>

<script>
export default {
  computed: {
    isLoggedIn() {
      return this.$store.getters["auth/isLoggedIn"]
    },
    errorCode() {
      return this.$store.state.error.code
    }
  },
  watch: {
    errorCode: {
      handler(val) {
        if (val >= 500) {
          this.$router.push('/system-error')
        }
      },
      immediate: true
    },
    $route() {
      this.$store.commit('error/setCode', null)
    }
  }
}
</script>