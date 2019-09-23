<template>
    <div class="champions">
        <div class="loading" v-if="loading">
            Loading...
        </div>

        <div v-if="error" class="error">
            {{ error }}
        </div>

        <ul v-if="champions">
            <li v-for="{ id, name, image_url, big_image_url, attackdamage, hp, movespeed } in champions">
                <strong>Name:</strong> {{ name }},
                <strong>Regular Image:</strong>
                <div>
                    <img :src="image_url" :alt="`image${image_url}`">
                </div>
                <strong>Big Image:</strong>
                <div>
                    <img :src="big_image_url" :alt="`big_image${image_url}`">
                </div>
                
                <strong>Base AD:</strong> {{ attackdamage }}
                <strong>Base HP:</strong> {{ hp }}
                <strong>Base Movespeed:</strong> {{ movespeed }}
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
        };
    },
    created() {
        this.fetchData();
    },
    methods: {
        fetchData() {
            this.error = this.champions = null;
            this.loading = true;
            axios
                .get('/api/champions')
                .then(response => {
                    this.loading = false;
                    this.champions = response.data;
                    console.log(response);
                });
        }
    }
}
</script>