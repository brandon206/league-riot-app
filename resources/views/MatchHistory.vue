<template>
    <div v-if="champions && matches">
        <div v-for="matchData in matches" :key="matchData.gameId" class="px-6 py-4">
            <div class="container mx-auto max-w-sm rounded overflow-hidden shadow-lg flex">
                <div class="h-48 lg:h-auto lg:w-48 flex-none bg-cover rounded-t lg:rounded-t-none lg:rounded-l text-center overflow-hidden">
                    <div class="text-gray-900 font-bold text-xl mb-2">{{ champions[matchData.champion]['id'] }}</div>
                    <img class="pb-6" style="margin: 0 auto;" :src="`${link}` + champions[matchData.champion]['image'].full" :alt="`image${champions[matchData.champion]['image'].full}`">
                </div>
                <div class="bg-white p-4 w-full flex justify-center items-center">
                    <div class="">
                    <p class="text-gray-700 text-base">{{`Lane: ${matchData.lane}`}}</p>
                    <p class="text-gray-700 text-base">{{`${matchData.role} Queue`}}</p>
                    <button type="button" class="bg-blue-500 hover:bg-blue-400 text-white font-bold py-2 px-4 border-b-4 border-blue-700 hover:border-blue-500 rounded"> Show Stats </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
export default {
    props: {
        matches: {
            type: Array,
            default: [],
        }
    },
    created() {
      this.fetchData();
    },
    data() {
        return {
            error: null,
            champions: {},
            link: process.env.MIX_CHAMPION_JSON_URL,
        };
    },
    methods: {
        fetchData() {
            this.error = this.champions = null;
            this.loading = true;
            axios
            .get('/api/champions')
            .then(response => {
                this.champions = Object.values(response.data.data).reduce((obj, value) => {
                    obj[value.key] = value;
                    return obj;
                }, {});
            });
        },
    },
}
</script>

<style>

</style>