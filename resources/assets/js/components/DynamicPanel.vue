<template>
    <div v-observe-visibility="visibilityChanged">
        <!--<div class="card" v-for="item in current_items">
            <div class="card-header">
                {{ item.question }}
            </div>
            <div class="card-body">
                <h5 class="card-title">{{ item.key }}</h5>
                <p class="card-text">{{ item.value }}</p>
            </div>
        </div>-->
        <b-card :title="item.question" v-for="item in current_items" :key="item.id">
            <h5 class="card-title">{{ item.key }}</h5>
            <p class="card-text">{{ item.value }}</p>
        </b-card>
    </div>
</template>

<script>
    export default {
        name: "DynamicPanel",
        //props: ['panel', 'batch_size', 'timeout'],
        props: {
            panel: {
                type: String
            },
            batch_size: {
                type: Number
            },
            timeout: {
                type: Number
            }
        },
        data() {
            return {
                counter: 0,
                isVisible: false
            }
        },
        computed: {
            current_items() {
                const from = this.counter;
                const to = this.counter + this.batch_size;
                return this.body.slice(from, to);
            },
            body() {
                //let body = Object.values(JSON.parse(this.panel)['body']);
                let body = Object.entries(JSON.parse(this.panel)['body']);
                let ret = [];
                let index = 0;
                body.forEach(function (el) {
                    let question = el[0];
                    let keys = Object.keys(el[1]);
                    let values = Object.values(el[1]);
                    for (let i = 0; i < keys.length; i++) {
                        ret.push({id: index, 'question': question, 'key': keys[i], 'value': values[i]});
                        index++;
                    }
                });
                //return Object.values(body);
                //console.log(ret);
                return this.shuffle(ret);
            }
        },
        methods: {
            shuffle(array) {
                for (let i = array.length - 1; i > 0; i--) {
                    const j = Math.floor(Math.random() * (i + 1));
                    [array[i], array[j]] = [array[j], array[i]];
                }

                return array;
            },
            visibilityChanged (isVisible, entry) {

                this.isVisible = isVisible;

                /*this.$nextTick(function () {
                    window.setInterval(() => {
                        if (this.counter < this.body.length - 1) {
                            this.counter += this.batch_size;
                        }
                    }, this.timeout * 1000);
                });*/
                setInterval(function() {
                    if (this.counter < this.body.length - 1) {
                        this.counter += this.batch_size;
                    }
                    console.log('SAD');
                }, this.timeout * 1000);
            }
        },
        mounted() {
            //this.batch_size = this.batch_size;
            //this.timeout = this.timeout;

            /*this.$nextTick(function () {
                window.setInterval(() => {
                    if (this.counter < this.body.length - 1) {
                        this.counter += this.batch_size;
                    }
                }, this.timeout * 1000);
            });*/
        },
    }
</script>

<style scoped>

</style>