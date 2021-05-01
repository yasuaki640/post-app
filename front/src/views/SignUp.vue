<template>
  <div class="about">
    <h1>Enter your account info</h1>
    <form @submit="register">
      <ul>
        <li>
          <label for="name">name :
            <input id="name" v-model="name" type="text">
          </label>
        </li>
        <li>
          <label for="email">email :
            <input id="email" v-model="email" type="email">
          </label>
        </li>
        <li>
          <label for="submit">
            <input id="submit" type="submit" value="Sign up">
          </label>
        </li>
      </ul>
    </form>
  </div>
</template>

<script>

export default {
  data() {
    return {
      name: '',
      email: '',
    }
  },
  methods: {
    register: function (e) {
      e.preventDefault()
      
      this.axios.post('/api/users', {
        name: this.name,
        email: this.email
      })
    },
  }
}
</script>
