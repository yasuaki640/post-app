<template>
  <div class="about">
    <h1>Edit your account info</h1>
    <form @submit.prevent="edit">
      <input type="hidden" id="id" :value="item.id">
      <ul>
        <li>
          <label for="name">name :
            <input id="name" v-model="item.name" type="text" required>
          </label>
        </li>
        <li>
          <label for="email">email :
            <input id="email" v-model="item.email" type="email" required>
          </label>
        </li>
        <li>
          <label for="password">password (Required if you want to change it.) :
            <input id="password" v-model="item.password" type="password">
          </label>
        </li>
        <li>
          <label for="password-confirm">password confirm (Required if you want to change it.) :
            <input id="password-confirm" v-model="item.password_confirm" type="password">
          </label>
        </li>
        <li>
          <label for="submit">
            <input id="submit" type="submit" value="Edit">
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
        id: this.$store.getters['auth/loginUser'].id,
        name: this.$store.getters['auth/loginUser'].name,
        email: this.$store.getters['auth/loginUser'].email,
        password: '',
        password_confirm: ''
      }
    }
  },
  mounted() {

  },
  methods: {
    edit: async function () {
      const response = await this.$store.dispatch('auth/edit', this.item);

      if (200 <= response.status && response.status <= 299) {
        alert('Success')
      } else {
        alert(JSON.stringify(response.data))
      }

      //Reload this page.
      this.$router.go(0)
    },
  }
}
</script>
