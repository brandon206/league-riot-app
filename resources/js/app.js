import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

import App from '../views/App'
import Hello from '../views/Hello'
import Home from '../views/Home'
import ChampionsIndex from '../views/ChampionsIndex'
import SoloChampionIndex from '../views/SoloChampionIndex'

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home
        },
        {
            path: '/hello',
            name: 'hello',
            component: Hello,
        },
        {
            path:'/champions',
            name: 'champions.index',
            component: ChampionsIndex,
        },
        {
            path:'/champions/:id',
            name: 'champions.id.index',
            component: SoloChampionIndex,
        }
    ],
});

const app = new Vue({
    el: '#app',
    components: { App },
    router,
});