<template>
    <div>
        <div>{{ singleMatchData.gameId }}</div>
        <div>{{ singleMatchData.gameMode }}</div>
        <div v-if="singleMatchData.participants">{{ this.checkIfWinOrLoss() }}</div>
        <div>
            <div v-for="summoner in singleMatchData.participantIdentities" :key="summoner.participantId">
                <strong>{{ summoner.player.summonerName }}</strong>
            </div>
            <div v-for="summonerChampionData in singleMatchData.participants">
                <strong>{{ summonerChampionData.championId }}</strong>
                <p>{{ summonerChampionData.timeline.role }}</p>
                <p>{{ summonerChampionData.timeline.lane }}</p>
            </div>
        </div>
        
    </div>
</template>

<script>
import axios from 'axios';

export default {
    props: {
        singleMatchStatsObj: {
            type: Object,
            default: {},
        },
        summonerName: {
            type: String,
            default: '',
        },
    },
    data() {
        return {
            loading: false,
            error: null,
            singleMatchData: {},
            summonerData: {},
            teamId: null,
            result: '',
        };
    },
    mounted() {
        // debugger;
        this.fetchSummonerSingleMatchData(this.singleMatchStatsObj);
    },
    methods: {
        checkIfWinOrLoss() {
            this.singleMatchData.participantIdentities.forEach( (participant) => {
                if (participant.player.summonerName === this.summonerName) {
                    this.summonerData = participant;
                }
            });
            this.singleMatchData.participants.forEach( (participant) => {
                if(participant.participantId === this.summonerData.participantId) {
                    this.teamId = participant.teamId;
                }
            });
            this.singleMatchData.teams.forEach( (team) => {
                if(team.teamId === this.teamId) {
                    debugger;
                    this.result = team.win;
                }
            });
            return this.result;
        },
        fetchSummonerSingleMatchData(obj) {
            // debugger;
            this.error = null;
            this.loading = true;
            // debugger;
            // console.log('Inside Fetching Summoner Single Match Data');
            axios
                .get(`/api/summonerSingleMatchData/${obj.matchId}`)
                .then(response => {
                    this.loading = false;
                    this.singleMatchData = response.data;
                    console.log('im getting a response: ', response);
                })
                .catch(error => {
                    this.loading = false;
                    this.error = error.response.data.message || error.message;
                    // console.log(this.error);
                }); 
        }
    },
}
</script>

<style>

</style>