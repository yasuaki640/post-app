<template>
  <div class="about">
    <h1>Enter your account info</h1>
    <form @submit.prevent="register">
      <ul>
        <li>
          <label for="name">name :
            <input id="name" v-model="item.name" type="text">
          </label>
        </li>
        <li>
          <label for="email">email :
            <input id="email" v-model="item.email" type="email">
          </label>
        </li>
        <li>
          <label for="password">password :
            <input id="password" v-model="item.password" type="password">
          </label>
        </li>
        <li>
          <label for="password-confirm">password (confirm) :
            <input id="password-confirm" v-model="item.password_confirm" type="password">
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
      item: {
        name: '',
        email: '',
        password: '',
        password_confirm: ''
      }
    }
  },
  methods: {
    register: async function () {
      console.log(this.item)

      // const res = await this.axios.post('/api/users', {
      //   name: this.name,
      //   email: this.email,
      //   password: this.password
      // })
    },
  }
}
</script>
