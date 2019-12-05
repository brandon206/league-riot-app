<template>
    <div>
        <div v-for="matchData in matches" :key="matchData.gameId" class="px-6 py-4">
            <p>{{ matchData.platformId }}</p>
            <p>{{ matchData.champion }}</p>
            <p>{{ matchData.role }}</p>
            <p>{{ matchData.lane }}</p>
        </div>
    </div>
</template>

<script>
export default {
    props: ['matches'],
}
</script>

<style>

</style>