<template>
    <div class="champions">
        <div class="search-wrapper">
            <form class="w-full max-w-sm">
                <div class="flex items-center">
                    <input v-model="search" class="bg-white focus:outline-none focus:shadow-outline border border-gray-300 rounded-lg py-2 px-4 block w-full appearance-none leading-normal" type="text" placeholder="Search Champions">
                </div>
            </form>
        </div>
        <div class="loading" v-if="loading">
            Loading...
        </div>
        <div v-if="error" class="error">
            {{ error }}
        </div>
        <div class="inline-block relative w-64">
            <select class="dropdownFilter block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline" v-model="selectedType">
                <option value="All"> All</option>
                <option value="Tank"> Tank</option>
                <option value="Marksman"> Marksman</option>
                <option value="Mage"> Mage</option>
                <option value="Fighter"> Fighter</option>
                <option value="Assassin"> Assassin</option>
            </select>
        </div>
        <ul v-if="champions">
            <li v-for="champion in filteredChampions" :key=champion.key>
                <strong>Name:</strong> {{ champion.id }},
                <strong>Title:</strong> {{ champion.title }},
                <strong>Regular Image:</strong>
                <div style="width: max-content">
                    <router-link :to="{ name: 'champions.id.index', params: {id: champion.id} }">
                        <img style="margin: 0" :src="`${link}` + champion.image.full" :alt="`image${champion.image.full}`">
                    </router-link>
                </div>
                <div v-for="tag in champion.tags" :key=tag>
                <strong>{{ tag }}</strong>
                </div>
                <strong>Base HP:</strong> {{ champion.stats.hp }}
                <strong>Base Movespeed:</strong> {{ champion.stats.movespeed }}
            </li>
        </ul>
    </div>
</template>
<script>
import axios from 'axios';

export default {
    data() {
        return {
            loading: false,
            champions: null,
            error: null,
            search: '',
            link: process.env.MIX_CHAMPION_JSON_URL,
            splashLink: process.env.MIX_CHAMPION_SPLASH_JSON_URL,
            selectedType: 'All',
        };
    },
    created() {
        this.fetchData();
        console.log(process.env.MIX_CHAMPION_JSON_URL);
    },
    methods: {
        fetchData() {
            this.error = this.champions = null;
            this.loading = true;
            axios
                .get('/api/champions')
                .then(response => {
                    this.loading = false;
                    this.champions = Object.values(response.data.data);
                    // console.log(this.champions);
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
    }
}
</script>