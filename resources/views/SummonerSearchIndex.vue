<template>
    <div style="text-align: center">
        <div class="loading" v-if="loading">
            Loading...
        </div>
        <template>
            <SearchBar @clickedSearch="handleSearchClick" :placeholderText="'Search Summoner'">
            </SearchBar>
        </template>
        <div v-if="summonerData" class="container mx-auto max-w-sm rounded overflow-hidden shadow-lg">
            <div v-for="summonerRanks in summonerData" :key="summonerRanks.leagueId" class="px-6 py-4">
                <img class="mx-auto w-32" :src="getTierImgUrl(summonerRanks.tier)" :alt="`${summonerRanks.tier}`">
                <div>
                    <div class="font-bold text-xl mb-2">{{ summoner.name }}</div>
                    <div class="text-gray-700 text-base">Level: {{ summoner.summonerLevel }}</div>
                    <div class="text-gray-700 text-base">{{ `${summonerRanks.tier} ${summonerRanks.rank}` }}</div>
                    <div class="text-gray-700 text-base">{{ summonerRanks.queueType }}</div>
                </div>
                <div>
                    <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2">{{ `LP: ${summonerRanks.leaguePoints}` }}</span>
                    <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2">{{ `Wins: ${summonerRanks.wins}` }}</span>
                    <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2">{{ `Loses: ${summonerRanks.losses}` }}</span>
                </div>
                <div>
                    <div class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded inline-flex items-center">
                        <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M13 8V2H7v6H2l8 8 8-8h-5zM0 18h20v2H0v-2z"/></svg>
                        <span>Match History</span>
                    </div>
                </div>
            </div>
        </div>
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
            summonerData: {},
            encryptId: '',
            // imageLink: 'http://ddragon.leagueoflegends.com/cdn/img/champion/loading/',
        };
    },
    created() {
        // console.log(this.$route.params.id);
        this.id = this.$route.params.id;
    },
    computed: {
        getImageLink: function(link) {
            return link;
        },
    },
    methods: {
        getTierImgUrl(tier) {
            return require(`../../resources/images/${tier}.png`);
        },
        handleSearchClick: function(summonerName) {
            // console.log('this be the summoner\'s name: ', summonerName);
            this.fetchSummoner(summonerName);
        },
        fetchSummoner(summonerName) {
            this.error = this.summoner = null;
            this.loading = true;
            console.log(summonerName);
            axios
                .get(`/api/summoner/${summonerName}`)
                .then(response => {
                    // this.loading = false;
                    this.summoner = response.data;
                    // console.log(this.summoner);
                    this.encryptId = response.data.id;
                    this.fetchSummonerData(this.encryptId);
                })
                .catch(error => {
                this.loading = false;
                this.error = error.response.data.message || error.message;
                // console.log(this.error);
                });
        },
        fetchSummonerData(encryptId) {
            this.error = this.summonerData = null;
            this.loading = true;
            // console.log(encryptId);
            axios
                .get(`/api/summonerData/${encryptId}`)
                .then(response => {
                    this.loading = false;
                    this.summonerData = response.data;
                    // console.log(response.data);
                })
                .catch(error => {
                this.loading = false;
                this.error = error.response.data.message || error.message;
                // console.log(this.error);
                });
        },
    },
}
</script>

<style>

</style>