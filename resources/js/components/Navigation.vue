<template>
    <ul class="navbar-nav mr-auto">
        <li v-for="item in items">
            <router-link :to="item.link">{{ item.name }}</router-link>
        </li>
    </ul>
</template>

<script>
    export default {
        name: "Navigation",
        data() {
            return {
                items: []
            }
        },
        mounted() {
            axios.get('menu').then(response => {
                this.items = response.data;
                //console.log(this.items);
            });
        },
    }
</script>

<style scoped>

</style>