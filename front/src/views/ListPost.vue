<template>
  <div class="list-post">
    <h1>Posts</h1>
    <template v-for="post in posts">
      <Post :post="post" :key="post.id"></Post>
    </template>
  </div>
</template>

<script>

import Post from "../components/Post";

export default {
  components: {Post},
  data() {
    return {
      posts: {}
    }
  },
  async mounted() {
    const response = await this.axios.get('/api/posts')
    this.posts = response.data
  },
}
</script>
