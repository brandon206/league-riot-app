<template>
    <div style="text-align: center">
        <div class="loading" v-if="loading">
            Loading...
        </div>
        <template>
            <SearchBar @clickedSearch="handleSearchClick" :placeholderText="'Search Summoner'">
            </SearchBar>
        </template>
        <ul v-if="summoner && summonerData">
            <li>
                <div>{{ summoner.name }}</div>
                <div>{{ summoner.summonerLevel }}</div>
            </li>
        </ul>
        <ul v-if="summonerData">
            <li v-for="summonerRanks in summonerData" :key="summonerRanks.leagueId">
                <div>{{ summonerRanks.queueType }}</div>
                <div>
                    <img :src="getTierImgUrl(summonerRanks.tier)" :alt="`${summonerRanks.tier}`">
                    {{ `${summonerRanks.tier} ${summonerRanks.rank}` }}
                </div>
                <div>{{ `LP: ${summonerRanks.leaguePoints}` }}</div>
                <div>{{ `Wins: ${summonerRanks.wins}` }}</div>
                <div>{{ `Loses: ${summonerRanks.losses}` }}</div>
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
            summonerData: {},
            encryptId: '',
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
        },
    },
    methods: {
        getTierImgUrl(tier) {
            return require(`../../resources/images/${tier}.png`);
        },
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
                    // this.loading = false;
                    this.summoner = response.data;
                    console.log(this.summoner);
                    this.encryptId = response.data.id;
                    this.fetchSummonerData(this.encryptId);
                })
                .catch(error => {
                this.loading = false;
                this.error = error.response.data.message || error.message;
                console.log(this.error);
                });
        },
        fetchSummonerData(encryptId) {
            this.error = this.summonerData = null;
            this.loading = true;
            console.log(encryptId);
            axios
                .get(`/api/summonerData/${encryptId}`)
                .then(response => {
                    this.loading = false;
                    this.summonerData = response.data;
                    console.log(response.data);
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