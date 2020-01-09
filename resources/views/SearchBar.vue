<template>
    <div class="search-wrapper">
        <form class="w-full max-w-sm" v-on:submit.prevent="$emit('clickedSearch', search)">
            <div class="flex items-center">
                <input v-model="search" class="bg-white focus:outline-none focus:shadow-outline border border-gray-300 rounded-lg py-2 px-4 block w-full appearance-none leading-normal" type="text" :placeholder="placeholderText">
                <button type="button"  v-on:click="$emit('clickedSearch', search)" class="bg-blue-500 hover:bg-blue-400 text-white font-bold py-2 px-4 border-b-4 border-blue-700 hover:border-blue-500 rounded">
                    Search
                </button>
            </div>
        </form>
    </div>
</template>

<script>
export default {
    props: ['placeholderText'],
    data() {
        return {
            search: '',
        }
    },
}
</script>

<style>

</style>