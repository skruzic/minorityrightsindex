<template>
    <ul class="navbar-nav mr-auto">
        <li>Test</li>
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
        created() {
            axios.get('menu').then(response => {
                this.items = response.data;
                console.log(response.data);
            });
        }
    }
</script>

<style scoped>

</style>