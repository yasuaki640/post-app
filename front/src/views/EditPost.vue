<template>
  <div class="about">
    <h1>Edit post body</h1>
    <form @submit.prevent="edit">
      <input type="hidden" id="id" :value="item.id">
      <ul>
        <li>
          <label for="body">body :
            <textarea id="body" v-model="item.body" required></textarea>
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
import axios from "axios"

export default {
  data() {
    return {
      item: {
        id: 0,
        body: '',
      }
    }
  },

  async mounted() {
    const response = await axios.get('api/posts/' + this.$route.query.id);
    this.item = response.data
  },

  methods: {
    edit: async function () {
      const response = await axios.put('api/posts', this.item);

      if (200 <= response.status && response.status <= 299) {
        alert('Success')
        await this.$router.push('/list-post')

      } else if (500 <= response.status) {
        await this.$router.push('/system-error')

      } else {
        alert(JSON.stringify(response.data))
      }
    },
  },
}
</script>
