<template>
    <div style="text-align: center">
        <div class="loading" v-if="loading">
            Loading...
        </div>
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
        fetchData() {
            // console.log(`/api/champions/${this.id}`);
            this.error = this.champion = null;
            this.loading = true;
            axios
                .get(`/api/champions/${this.id}`)
                .then(response => {
                    this.loading = false;
                    this.champion = Object.values(response.data.data);
                    console.log(this.champion);
                });
        },
    },
}
</script>

<style>

</style>