<template>
  <div class="list-post">
    <h1>Posts</h1>
    <Post></Post>
  </div>
</template>

<script>

export default {
  data() {
    return {
      posts: {}
    }
  },
  async mounted() {
    const response = (await this.axios.get('/api/posts'))
    this.posts = response.data
  },
  methods: {}
}
</script>
