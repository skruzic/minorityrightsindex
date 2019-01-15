<template>
    <div class="card">
        <div class="card-body">

        </div>
    </div>
</template>

<script>
    export default {
        name: "DynamicPanel",
        props: ['items'],
        data() {
            return {
                counter: 0
            }
        },
        computed: {
            current() {
                return this.items[this.counter];
            }
        },
        methods: {
            shuffle() {

            }
        },
        mounted() {
            this.$nextTick(function () {
                window.setInterval(() => {
                    if (this.counter < this.items.length - 1) {
                        this.counter++;
                    }
                }, 10000);
            })
        }
    }
</script>

<style scoped>

</style>