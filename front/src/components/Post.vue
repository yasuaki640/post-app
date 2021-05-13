<template>
  <div class="post">
    <table>
      <tbody>
      <tr>
        <th>id</th>
        <th>user_id</th>
        <th colspan="2">sent_at</th>
      </tr>
      <tr>
        <td>{{ post.id }}</td>
        <td>{{ post.user_id }}</td>
        <td colspan="2">{{ displayTime }}</td>
      </tr>
      <tr>
        <td colspan="2">{{ post.body }}</td>
        <td>
          <router-link v-if="isBelongsToLoginUser" :to="{ path: 'edit-post', query : { id : post.id }}">edit</router-link>
        </td>
        <td>
          <button v-if="isBelongsToLoginUser">delete</button>
        </td>
      </tr>
      </tbody>
    </table>
  </div>
</template>

<script>

export default {
  props: {
    post: {
      id: {
        type: Number,
        required: true
      },
      user_id: {
        type: Number,
        required: true
      },
      body: {
        type: String,
        required: true
      },
      created_at: {
        type: String,
        required: true
      }
    }
  },
  methods: {
    isToday(date) {
      const today = new Date();
      return date.toDateString() === today.toDateString();
    }
  },
  computed: {
    isBelongsToLoginUser: function () {
      return this.post.user_id === this.$store.getters['auth/loginUser'].id;
    },
    displayTime: function () {
      if (!this.post.created_at) {
        return
      }

      const sentAtDate = new Date(this.post.created_at)

      if (this.isToday(sentAtDate)) {
        const h = sentAtDate.getHours().toString().padStart(2, '0')
        const m = sentAtDate.getMinutes().toString().padStart(2, '0')
        return `${h}:${m}`

      } else {
        const m = (sentAtDate.getMonth() + 1).toString().padStart(2, '0')
        const d = sentAtDate.getDate().toString().padStart(2, '0')
        return `${m}/${d}`
      }
    }
  }
}
</script>
