<template>
    <div style="text-align: center">
        <div class="loading" v-if="loading">
            Loading...
        </div>
        <button type="button" class="bg-blue-500 hover:bg-blue-400 text-white font-bold py-2 px-4 border-b-4 border-blue-700 hover:border-blue-500 rounded" @click="goBack"> Go Back </button>
        <ul v-if="champion">
            <li v-for="champ in champion" :key=champ.key>
                <div>{{  champ.id  }}</div>
                <div>
                    <img style="margin: 0 auto" :src="imageLink + champ.name + '_0.jpg'" alt="">
                </div>
                <div>{{ champ.title }}</div>
                <div>{{ champ.lore }}</div>
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
            champion: null,
            error: null,
            id: null,
            imageLink: 'http://ddragon.leagueoflegends.com/cdn/img/champion/loading/',
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
        goBack() {
            this.$router.go(-1);
        },
        fetchData() {
            this.error = this.champion = null;
            this.loading = true;
            axios
                .get(`/api/champions/${this.id}`)
                .then(response => {
                    this.loading = false;
                    this.champion = Object.values(response.data.data);
                });
        },
    },
}
</script>

<style>

</style>