<template>
  <div class="hello">
    <h1>{{ msg }}</h1>
    <ul>
      <li v-for="p in paginated" :key="p.id">{{p.id}}</li>
    </ul>
    <button :disabled="page === 0" @click="prevPage">Previous</button>
    <button :disabled="page >= pageCount - 1" @click="nextPage">Next</button>
  </div>
</template>

<script>
export default {
  name: "Pagination",
  data() {
    return {
      msg: "Champions",
      page: 0
    };
  },
  props: {
    champions: { type: Array, required: true },
    size: { type: Number, required: false, default: 10 }
  },
  methods: {
    nextPage() {
      this.page++;
    },
    prevPage() {
      this.page--;
    }
  },
  computed: {
    pageCount() {
      let l = this.champions.length,
        s = this.size;
      return Math.floor(l / s);
    },
    paginated() {
      const start = this.page * this.size,
        end = start + this.size;
      return this.champions.slice(start, end);
    }
  }
};
</script>

<style scoped>
</style>
