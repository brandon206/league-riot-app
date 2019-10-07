<template>
    <div style="text-align: center">
        <div class="loading" v-if="loading">
            Loading...
        </div>
        <SearchBar :placeholderText="'Search Summoner'">
        </SearchBar>
        <!-- <div class="search-wrapper">
            <form class="w-full max-w-sm">
                <div class="flex items-center">
                    <input v-model="search" class="bg-white focus:outline-none focus:shadow-outline border border-gray-300 rounded-lg py-2 px-4 block w-full appearance-none leading-normal" type="text" placeholder="Search Champions">
                </div>
            </form>
        </div> -->
        <!-- <ul v-if="summoner"> -->
            <!-- <li v-for="summoner in summoner" :key=summoner.id> -->
                <!-- <div>{{  summoner.name  }}</div> -->
                <!-- <div>
                    <img style="margin: 0 auto" :src="imageLink + champ.name + '_0.jpg'" alt="">
                </div> -->
                <!-- <div>{{ summoner.summonerLevel }}</div> -->
                <!-- <div>{{ champ.lore }}</div> -->
            <!-- </li> -->
        <!-- </ul> -->
    </div>
    
</template>

<script>
import axios from 'axios';
import SearchBar from './SearchBar';

export default {
    components: {
        'SearchBar': SearchBar
    },
    data() {
        return {
            loading: false,
            champion: null,
            error: null,
            id: null,
            search: '',
            // imageLink: 'http://ddragon.leagueoflegends.com/cdn/img/champion/loading/',
        };
    },
    created() {
        console.log(this.$route.params.id);
        this.id = this.$route.params.id;
        this.fetchData();
    },
    computed: {
        getImageLink: function(link) {
            return link;
        }
    },
    methods: {
        fetchData() {
            // console.log(`/api/champions/${this.id}`);
            this.error = this.summoner = null;
            this.loading = true;
            axios
                .get(`/api/summoner/Beautiful Noona`)
                .then(response => {
                    this.loading = false;
                    this.summoner = response.data;
                    console.log(this.summoner);
                });
        },
    },
}
</script>

<style>

</style>