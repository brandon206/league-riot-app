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
                    <button type="button" v-on:click="handleMatchHistoryClick" class="bg-blue-800 hover:bg-blue-900 text-white font-bold py-2 px-4 border-b-4 border-blue-900 hover:border-blue-900 rounded">
                        Match History
                    </button>
                </div>
            </div>
        </div>
        <MatchHistory
            v-if="matches && ! singleMatchStatsObj.showSingleMatchStats"
            :matches="matches"
            @clickedShowStats="handleShowStatsClick"
        >
        </MatchHistory>
        <SingleMatchData
            v-if="singleMatchStatsObj.showSingleMatchStats"
            :singleMatchStatsObj="this.singleMatchStatsObj"
            :summonerName="this.summonerName"
        >
        </SingleMatchData>
    </div>
</template>

<script>
import axios from 'axios';
import SearchBar from './SearchBar';
import MatchHistory from './Player/MatchHistory';
import SingleMatchData from './Player/SingleMatchData';

export default {
    components: {
        'SearchBar': SearchBar,
        'MatchHistory': MatchHistory,
        'SingleMatchData': SingleMatchData,
    },
    data() {
        return {
            loading: false,
            champion: null,
            error: null,
            id: null,
            accountId: null,
            summoner: '',
            summonerName: '',
            summonerData: {},
            encryptId: '',
            matches: [],
            singleMatchStatsObj: {},
        };
    },
    created() {
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
            this.summonerName = summonerName;
            this.fetchSummoner(summonerName);
        },
        handleMatchHistoryClick() {
            this.fetchSummonerMatchHistory();
        },
        handleShowStatsClick(obj) {
            this.showSingleMatchStats = obj.showSingleMatchStats;
            this.singleMatchStatsObj = obj;
        },
        fetchSummoner(summonerName) {
            this.error = this.summoner = null;
            this.loading = true;
            axios
                .get(`/api/summoner/${summonerName}`)
                .then(response => {
                    this.summoner = response.data;
                    this.encryptId = response.data.id;
                    this.accountId = response.data.accountId;
                    this.fetchSummonerData(this.encryptId);
                })
                .catch(error => {
                this.loading = false;
                this.error = error.response.data.message || error.message;
                });
        },
        fetchSummonerData(encryptId) {
            this.error = this.summonerData = null;
            this.loading = true;
            axios
                .get(`/api/summonerData/${encryptId}`)
                .then(response => {
                    this.loading = false;
                    this.summonerData = response.data;
                })
                .catch(error => {
                this.loading = false;
                this.error = error.response.data.message || error.message;
                });
        },
        fetchSummonerMatchHistory() {
            this.error = this.matches = null;
            this.loading = true;
            axios
                .get(`/api/summonerMatchHistory/${this.accountId}`)
                .then(response => {
                    this.loading = false;
                    this.matches = response.data.matches;
                })
                .catch(error => {
                    this.loading = false;
                    this.error = error.response.data.message || error.message;
                });
        },
    },
}
</script>

<style>

</style>