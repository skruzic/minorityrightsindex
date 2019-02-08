<template>
    <table class="table table-striped">
        <thead class="thead-dark">
            <th v-for="th in JSON.parse(question.panel)['header']">{{ th }}</th>
        </thead>
        <tbody>
            <tr v-for="(tr, key, i) in JSON.parse(question.panel)['body']">
                <th>{{ key }}</th>
                <td v-for="(td, key2, j) in tr">
                    <span class="d-none">{{ td }}</span>
                    <div class="d-block">
                        <button class="btn btn-outline-primary" v-model="clicks"
                                @click.prevent="handleClick($event, i, j)">Otvori
                        </button>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</template>

<script>
    export default {
        name: "StaticPanel",
        props: ['question', 'timeout'],
        data() {
            return {
                clicks: []
            }
        },
        methods: {
            handleClick: function (event, i, j) {
                let btn = $(event.target);
                btn.parent().prev().toggleClass('d-none');
                /*btn.text(function(i,text) {
                    return text === 'Otvori' ? 'Zatvori' : 'Otvori';
                });*/

                // Emitiram klik event s podacima
                // Prvi broj je redak, drugi stupac
                // Nulti redak ili stupac se smatraju pitanje, odnosno zaglavlje
                this.clicks.push([i + 1, j + 1].join(','));
                this.$emit('input', this.clicks);

                // Sakrij botun
                btn.toggleClass('d-none');

                if (this.timeout > 0) {
                    setTimeout(function () {
                        btn.parent().prev().toggleClass('d-none');
                        btn.toggleClass('d-none');
                    }, this.timeout * 1000);
                }
            },
        },
        computed: {
            parsedPanel() {
                return JSON.parse(this.question.panel);
            }
        },
        mounted() {
            this.$emit('input', this.clicks);
        }
    }
</script>

<style scoped>

</style>