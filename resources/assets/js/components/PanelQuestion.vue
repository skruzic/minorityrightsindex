<template>
    <table class="table table-striped">
        <thead class="thead-dark">
            <th v-for="th in JSON.parse(question.panel)['header']">{{ th }}</th>
        </thead>
        <tbody>
            <tr v-for="(tr, key) in JSON.parse(question.panel)['body']">
                <th>{{ key }}</th>
                <td v-for="td in tr">
                    <span class="d-none">{{ td }}</span>
                    <div class="d-block">
                        <button class="btn btn-outline-primary" @click="handleClick">Otvori</button>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</template>

<script>
    export default {
        name: "PanelQuestion",
        props: ['question'],
        methods: {
            handleClick: function (event) {
                let btn = $(event.target);
                btn.parent().prev().toggleClass('d-none');
                btn.text(function(i,text) {
                    return text === 'Otvori' ? 'Zatvori' : 'Otvori';
                });
                //btn.prev().toggleClass('d-none');
            }
        },
        computed: {
            parsedPanel() {
                return JSON.parse(this.question.panel);
            }
        }
    }
</script>

<style scoped>

</style>