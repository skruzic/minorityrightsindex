<template>
    <div class="card">
        <div class="card-body">
            {{ current }}
        </div>
    </div>
</template>

<script>
    export default {
        name: "DynamicPanel",
        props: ['panel'],
        data() {
            return {
                counter: 0
            }
        },
        computed: {
            current() {
                return this.body[this.counter];
            },
            body() {
                let body = JSON.parse(this.panel)['body'];
                return Object.values(body);
            }
        },
        methods: {
            shuffle(array) {

            }
        },
        mounted() {
            this.$nextTick(function () {
                window.setInterval(() => {
                    if (this.counter < this.body.length - 1) {
                        this.counter++;
                    }
                }, 2000);
            })
        }
    }
</script>

<style scoped>

</style>