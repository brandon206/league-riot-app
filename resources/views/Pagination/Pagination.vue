<template>
  <div>
    <div class="text-center">
        <h1 class="text-gray-800 text-3xl font-bold">{{ headline }}</h1>
    </div>
    <div class="text-center flex flex-wrap justify-center">
        <div style="width: 25%; box-sizing: border-box;" v-for="p in paginatedChampions" :key="p.id">
            <div class="px-6 py-4">
                <div class="font-bold text-xl mb-2">{{ p.id }}</div>
                <p class="text-gray-700 text-base">{{ p.title }}</p>
            </div>
            <div style="width: 90%; margin: 0 auto;" class="gray-400 max-w-sm rounded overflow-hidden shadow-lg">
            <router-link :to="{ name: 'champions.id.index', params: {id: p.id} }">
                <img style="margin: 0 auto;" :src="`${link}` + p.image.full" :alt="`image${p.image.full}`">
            </router-link>
            <div class="px-6 py-4">
                <div class="font-bold text-xl mb-2">{{ p.id }}</div>
                <p class="text-gray-700 text-base">{{ p.title }}</p>
            </div>
            <div class="px-6 py-4">
                <span v-for="tag in p.tags" :key=tag>
                <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2">
                    <strong>{{ tag }}</strong>
                </span>
                </span>
            </div>
            </div>
        </div>
    </div>
    <div class="text-center px-6 py-4">
        <button
            v-if="isFirstPage"
            type="button"
            class="bg-red-500 hover:bg-red-400 text-white font-bold py-2 px-4 border-b-4 border-red-700 hover:border-red-500 rounded opacity-50 cursor-not-allowed"
            :disabled="isFirstPage"
            @click="prevPage"
        >Previous</button>
        <button
            v-else
            type="button"
            class="bg-blue-500 hover:bg-blue-400 text-white font-bold py-2 px-4 border-b-4 border-blue-700 hover:border-blue-500 rounded"
            @click="prevPage"
        >Previous</button>
        <button
            v-if="isLastPage"
            type="button"
            class="bg-red-500 hover:bg-red-400 text-white font-bold py-2 px-4 border-b-4 border-red-700 hover:border-red-500 rounded opacity-50 cursor-not-allowed"
            :disabled="isLastPage"
            @click="nextPage"
        >Next</button>
        <button
            v-else
            type="button"
            class="bg-blue-500 hover:bg-blue-400 text-white font-bold py-2 px-4 border-b-4 border-blue-700 hover:border-blue-500 rounded"
            @click="nextPage"
        >Next</button>
    </div>
  </div>
</template>

<script>
export default {
  name: "Pagination",
  data() {
    return {
      headline: "Champions",
      page: 0
    };
  },
  props: {
    champions: { type: Array, required: true },
    size: { type: Number, required: false, default: 8 },
    link: { type: String, required: true },
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
    isFirstPage() {
        console.log('is first page: ', this.page===0);
        return this.page === 0;
    },
    isLastPage() {
        console.log('is last page: ', this.page>=this.pageCount - 1);
        return this.page >= this.pageCount - 1;
    },
    pageCount() {
      let l = this.champions.length,
        s = this.size;
      return Math.ceil(l / s);
    },
    paginatedChampions() {
      const start = this.page * this.size,
        end = start + this.size;
      return this.champions.slice(start, end);
    }
  }
};
</script>

<style scoped>
</style>
