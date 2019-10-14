<template>
    <div style="text-align: center">
        <div class="loading" v-if="loading">
            Loading...
        </div>
        <template>
            <SearchBar @clickedSearch="handleSearchClick" :placeholderText="'Search Summoner'">
            </SearchBar>
        </template>
        <ul v-if="summoner">
            <li>
                <div>{{ summoner.name }}</div>
                <div>{{ summoner.summonerLevel }}</div>
            </li>
        </ul>
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
            summoner: '',
            // imageLink: 'http://ddragon.leagueoflegends.com/cdn/img/champion/loading/',
        };
    },
    created() {
        console.log(this.$route.params.id);
        this.id = this.$route.params.id;
    },
    computed: {
        getImageLink: function(link) {
            return link;
        }
    },
    methods: {
        handleSearchClick: function(summonerName) {
            console.log('this be the summoner\'s name: ', summonerName);
            this.fetchSummoner(summonerName);
        },
        fetchSummoner(summonerName) {
            this.error = this.summoner = null;
            this.loading = true;
            console.log(summonerName);
            axios
                .get(`/api/summoner/${summonerName}`)
                .then(response => {
                    this.loading = false;
                    this.summoner = response.data;
                    console.log(this.summoner);
                })
                .catch(error => {
                this.loading = false;
                this.error = error.response.data.message || error.message;
                console.log(this.error);
                });
        },
    },
}
</script>

<style>

</style>