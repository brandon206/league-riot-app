<template>
    <div class="search-wrapper">
        <form class="w-full max-w-sm">
            <div class="flex items-center">
                <input v-model="search" class="bg-white focus:outline-none focus:shadow-outline border border-gray-300 rounded-lg py-2 px-4 block w-full appearance-none leading-normal" type="text" :placeholder="placeholderText">
            </div>
        </form>
    </div>
</template>

<script>
export default {
    props: ['placeholderText'],
}
</script>

<style>

</style>