<template>
  <div>
      <h1>Riot App</h1>

      <p>
          <router-link :to="{ name: 'home' }">Home</router-link>
          <router-link :to="{ name: 'summonersearch.index' }">Summoner Search</router-link>
          <router-link :to="{ name: 'champions.index' }">Champions</router-link>
          <!-- <router-link :to="{ name: 'champions.id.index', params: {id: 'Aatrox'} }">Champion</router-link> -->
      </p>

      <div>
          <!--this is where our router will render the given component that matches the route-->
          <router-view></router-view>
      </div>
  </div>
</template>

<script>
export default {

}
</script>

<style>

</style>