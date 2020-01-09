<template>
  <div class="champions" style="margin: 0 auto;">
    <div class="search-wrapper inline-block">
      <form class="w-full max-w-sm">
        <div class="flex items-center">
          <input v-model="search" class="bg-white focus:outline-none focus:shadow-outline border border-gray-300 rounded-lg py-2 px-4 block w-full appearance-none leading-normal" type="text" placeholder="Search Champions">
        </div>
      </form>
    </div>
    <div v-if="error" class="error">{{ error }}</div>
      <div class="inline-block relative inline-block">
        <select class="dropdownFilter block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline" v-model="selectedType">
          <option value="All"> All</option>
          <option value="Tank"> Tank</option>
          <option value="Marksman"> Marksman</option>
          <option value="Mage"> Mage</option>
          <option value="Fighter"> Fighter</option>
          <option value="Assassin"> Assassin</option>
        </select>
      </div>
      <!-- <div v-if="champions" style="text-align: center; display: flex; flex-wrap: wrap; justify-content: center;">
        <div style="width: 25%; box-sizing: border-box;" v-for="champion in filteredChampions" :key=champion.key>
          <div style="width: 90%; margin: 0 auto;" class="gray-400 max-w-sm rounded overflow-hidden shadow-lg">
            <router-link :to="{ name: 'champions.id.index', params: {id: champion.id} }">
              <img style="margin: 0 auto;" :src="`${link}` + champion.image.full" :alt="`image${champion.image.full}`">
            </router-link>
            <div class="px-6 py-4">
              <div class="font-bold text-xl mb-2">{{ champion.id }}</div>
              <p class="text-gray-700 text-base">{{ champion.title }}</p>
            </div>
            <div class="px-6 py-4">
              <span v-for="tag in champion.tags" :key=tag>
                <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2">
                  <strong>{{ tag }}</strong>
                </span>
              </span>
            </div>
          </div>
        </div>
      </div> -->
      <div class="loading" v-if="loading">Loading...</div>
      <Pagination
        v-if="champions"
        :champions="filteredChampions"
        :link="this.link"
      />
    </div>
</template>
<script>
import axios from 'axios';
import Pagination from './Pagination/Pagination'

export default {
  name: "Champions",
  static: {
    visibleItemsPerPageCount: 2,
  },
  components: {
    'Pagination': Pagination,
  },
  data() {
    return {
      loading: false,
      champions: [],
      error: null,
      search: '',
      link: process.env.MIX_CHAMPION_JSON_URL,
      splashLink: process.env.MIX_CHAMPION_SPLASH_JSON_URL,
      selectedType: 'All',
      // championItems: [],
      currentPage: 1,
      pageCount: 0,
    };
  },
    created() {
      this.fetchData();
      // console.log(process.env.MIX_CHAMPION_JSON_URL);
    },
    methods: {
      async pageChangeHandle(value) {
        switch (value) {
          case 'next':
            this.currentPage += 1
            break
          case 'previous':
            this.currentPage -= 1
            break
          default:
            this.currentPage = value;
        }
      },
      fetchData() {
        this.error = this.champions = null;
        this.loading = true;
        axios
          .get('/api/champions')
          .then(response => {
            this.loading = false;
            this.champions = Object.values(response.data.data);
            this.pageCount = Math.ceil(this.champions /  this.$options.static.visibleItemsPerPageCount);
          });
      },
      
    },
    computed: {
      filteredChampions() {
        if (this.loading === false && this.champions) {
            let filtered = this.champions;
            if (this.search) {
                filtered = this.champions.filter(champ => champ.id.toLowerCase().includes(this.search.toLowerCase()));
            }
            if (this.selectedType !== "All") {
                let championTagsAsString;
                filtered = filtered.filter(champ => {
                    championTagsAsString = champ.tags.join();
                    return championTagsAsString.includes(this.selectedType);
                });
            }
            return filtered;
        }
      },
  },
};
</script>