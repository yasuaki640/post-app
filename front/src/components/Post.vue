<template>
  <div class="post">
    <hr>
    <p>id :{{ post.id }} user_id:{{ post.user_id }} sentAt:{{ changeDisplayTimeBySentAt(post.created_at) }}</p>
    <p>{{ post.body }}</p>
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
