<template>
    <div class="champions">
        <div class="search-wrapper">
            <form class="w-full max-w-sm">
                <div class="flex items-center">
                    <input v-model="search" class="bg-white focus:outline-none focus:shadow-outline border border-gray-300 rounded-lg py-2 px-4 block w-full appearance-none leading-normal" type="text" placeholder="Search Champions">
                </div>
            </form>
            <!-- <input class="bg-white focus:outline-none focus:shadow-outline border border-gray-300 rounded-lg py-2 px-4 block w-full appearance-none leading-normal" type="email" placeholder="jane@example.com"> -->
            <!-- <input type="text" v-model="search" placeholder="Search title.."/> -->
        </div>
        <div class="loading" v-if="loading">
            Loading...
        </div>
        <div v-if="error" class="error">
            {{ error }}
        </div>
        <div class="inline-block relative w-64">
            <select class="dropdownFilter block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline" v-model="selectedType">
                <option value="All"> All</option>
                <option value="Tank"> Tank</option>
                <option value="Marksman"> Marksman</option>
                <option value="Mage"> Mage</option>
                <option value="Fighter"> Fighter</option>
                <option value="Assassin"> Assassin</option>
            </select>
        </div>
        
            
        <!-- <div class="filter">
            <label for="component-dropdown">Component-based dropdown: </label>
            <dropdown id="component-dropdown" :options="championTypeOptions" v-model="selectedChampionType"></dropdown>
        </div> -->
        <!-- <ul v-if="champions">
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
        </ul> -->
        <ul v-if="champions">
            <li v-for="champion in filteredChampions" :key=champion.key>
                <strong>Name:</strong> {{ champion.id }},
                <strong>Title:</strong> {{ champion.title }},
                <strong>Regular Image:</strong>
                <div>
                    <img :src="link + champion.image.full" :alt="`image${champion.image.full}`">
                </div>
                <!-- <strong>Big Image:</strong>
                <div v-if="champion.image.sprite == 'champion0.png'">
                    <img :src="splashLink + champion.id + '_0.jpg'" :alt="`image${champion.image.sprite}`">
                </div>
                 -->
                <!-- <strong v-for="tag in champion.tags" :key=tag>Type:</strong> {{ tag }} -->
                <div v-for="tag in champion.tags" :key=tag>
                <strong>{{ tag }}</strong>
                </div>
                <strong>Base HP:</strong> {{ champion.stats.hp }}
                <strong>Base Movespeed:</strong> {{ champion.stats.movespeed }}
            </li>
        </ul>
    </div>
</template>
<script>
import axios from 'axios';
// import Dropdown from './Dropdown';

export default {
    // components: {
    //     'dropdown': Dropdown,
    // },
    data() {
        return {
            loading: false,
            champions: null,
            error: null,
            search: '',
            link: "http://ddragon.leagueoflegends.com/cdn/9.19.1/img/champion/",
            splashLink: "http://ddragon.leagueoflegends.com/cdn/img/champion/loading/",
            // championTypeOptions: {
            //     'Fighter': 'Fighter',
            //     'Tank': 'Tank',
            //     'Mage': 'Mage',
            //     'Assassin': 'Assassin',
            //     'Support': 'Support',
            //     'Marksman': 'Marksman',
            // },
            selectedType: 'All',
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
                    this.champions = Object.values(response.data.data);
                    console.log(this.champions);
                });
        },
        // chunkChampionData() {
        //     if(!this.loading){
        //         let tempArray = [];
        //         for(var i = 0; i < this.champions.length; i++) {
        //             tempArray.push(this.champions[i]);
        //             if( i % 25) {
        //                 this.championsChunks.push(tempArray);
        //             }
        //         }
        //         console.log(this.championsChunks);
        //     }
        // },
        // chunkResponseData(array, chunk) {
        //     let i,j,temparray;
        //     for(i = 0, j = array.length; i < j; i+=chunk) {
        //         temparray = array.slice(i,i+chunk);
        //         array.push(temparray);
        //     }
        // },
    },
    computed: {
        // filteredChampions() {
        //     if (this.loading === false) {
        //         console.log(this.champions);
        //         return this.champions.filter(champ => {
        //             return champ.id.toLowerCase().includes(this.search.toLowerCase())
        //         })
        //     }
        // },
        // filteredChampionTypes() {
        //     if (this.loading === false) {
        //         if (this.search != '') {
        //             return this.champions.filter(champ => {
        //                 return champ.id.toLowerCase().includes(this.search.toLowerCase())
        //             });
        //         } else {
        //             let category = this.selectedType;
        //         if(category === "All") {
        //             return this.champions;
        //         } else {
        //             let championTagsAsString;
        //             return this.champions.filter(function(champion) {
        //                 championTagsAsString = champion.tags.join();
        //                 return championTagsAsString.includes(category);
        //             });
        //         }
        //         }
        //     }
        // },
        filteredChampions() {
            if (this.loading === false && this.champions) {
                let filtered = this.champions;
                if (this.search) {
                    filtered = this.champions.filter(champ => champ.id.toLowerCase().includes(this.search.toLowerCase()));
                }
                if (this.selectedType !== "All") {
                    let championTagsAsString;
                    filtered = filtered.filter(champ => {
                        championTagsAsString = champ.tags.join();
                        return championTagsAsString.includes(this.selectedType);
                    });
                }
                return filtered;
            }
        },
    }
}
</script>