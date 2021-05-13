<template>
  <div class="about">
    <h1>Enter post body</h1>
    <form @submit.prevent="create">
      <input type="hidden" id="id" :value="item.id">
      <ul>
        <li>
          <label for="body">body :
            <textarea id="body" v-model="item.body" required></textarea>
          </label>
        </li>
        <li>
          <label for="submit">
            <input id="submit" type="submit" value="Create">
          </label>
        </li>
      </ul>
    </form>
  </div>
</template>

<script>
import axios from "axios"

export default {
  props: {
    post: {
      user_id: {
        type: Number,
        required: true
      },
      body: {
        type: String,
        required: true
      }
    }
  },
  data() {
    const user = this.$store.getters['auth/loginUser']
    return {
      item: {
        user_id: user.id,
        body: ''
      }
    }
  },
  methods: {
    create: async function () {
      const response = await axios.post('api/posts', this.item);

      if (200 <= response.status && response.status <= 299) {
        alert('Success')
      } else if (500 <= response.status) {
        await this.$router.push('/system-error')
      } else {
        alert(JSON.stringify(response.data))
      }

      this.item.body = ''
    },
  }
}
</script>
