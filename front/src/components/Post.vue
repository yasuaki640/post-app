<template>
  <div class="post">
    <hr>
    <p>id :{{ post.id }} user_id:{{ post.user_id }} sentAt:{{post.created_at}}</p>
    <p>{{ post.body }}</p>
  </div>
</template>

<script>

export default {
  props: {
    post: {
      type: Object,
      required: true
    }
  }
}
</script>
