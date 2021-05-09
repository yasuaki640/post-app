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
        <td colspan="2">{{ post.created_at }}</td>
      </tr>
      <tr>
        <td colspan="2">{{ post.body }}</td>
        <td><button>edit</button></td>
        <td><button>delete</button></td>
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
    // if sent at is today return hh:mm time str、else mm/dd time str。
    changeDisplayTimeBySentAt(sentAtStr) {
      if (!sentAtStr) {
        return
      }

      const sentAtDate = new Date(sentAtStr)

      if (this.isToday(sentAtDate)) {
        const h = sentAtDate.getHours().toString().padStart(2, '0')
        const m = sentAtDate.getMinutes().toString().padStart(2, '0')
        return `${h}:${m}`

      } else {
        const m = (sentAtDate.getMonth() + 1).toString().padStart(2, '0')
        const d = sentAtDate.getDate().toString().padStart(2, '0')
        return `${m}/${d}`
      }
    },

    isToday(date) {
      const today = new Date();
      return date.toDateString() === today.toDateString();
    }
  }
}
</script>
