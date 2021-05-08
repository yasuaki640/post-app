<template>
  <div class="post">
    {{ post }}
  </div>
</template>

<script>

export default {
  data() {
    return {
      post: {
        id: 0,
        user_id: 0,
        body: '',
        created_at: '',
        updated_at: '',
      }
    }
  }
}
</script>
