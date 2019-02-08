<template>
    <div>
        <b-card :title="item.question" v-for="(item, index) in current_items" :key="item.id">
            <h5 class="card-title">{{ item.key }}</h5>
            <div class="d-block">
                <button class="btn btn-outline-primary" v-model="clicks"
                        @click.prevent="handleClick($event, item.question, item.key)">Otvori
                </button>
            </div>
            <p class="card-text d-none">{{ item.value }}</p>
        </b-card>
    </div>
</template>

<script>
    import inViewport from 'vue-in-viewport-mixin';

    export default {
        name: "DynamicPanel",
        mixins: [inViewport],
        props: {
            panel: {
                type: String
            },
            batch_size: {
                type: Number
            },
            timeout: {
                type: Number
            },
            active_tab_index: {
                type: Number
            },
            section_index: {
                type: Number
            }
        },
        data() {
            return {
                counter: 0,
                is_ran: false,
                clicks: [],
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
            },
        },
        methods: {
            shuffle(array) {
                for (let i = array.length - 1; i > 0; i--) {
                    const j = Math.floor(Math.random() * (i + 1));
                    [array[i], array[j]] = [array[j], array[i]];
                }

                return array;
            },
            loop_items() {
                if (!this.is_ran) {
                    this.is_ran = !this.is_ran;

                    this.$nextTick(function () {
                        window.setInterval(() => {
                            if (this.counter < this.body.length - 1) {
                                this.counter++;
                                this.counter += parseInt(this.batch_size);
                            }

                        }, this.timeout * 1000);
                    });
                }
            },
            handleClick: function (event, i, j) {
                let btn = $(event.target);
                btn.parent().next().toggleClass('d-none');

                // Emitiram klik event s podacima
                // Prvi broj je redak, drugi stupac
                // Nulti redak ili stupac se smatraju pitanje, odnosno zaglavlje
                this.clicks.push("(" + i + "-" + j + ")");
                this.$emit('input', this.clicks);

                // Sakrij botun
                btn.toggleClass('d-none');
            },
        },
        mounted() {
            this.$emit('input', this.clicks);
        },
        watch: {
            active_tab_index: function (val, old) {
                if (val === this.section_index) {
                    this.loop_items();
                }

            }
        }
    }
</script>

<style scoped>

</style>