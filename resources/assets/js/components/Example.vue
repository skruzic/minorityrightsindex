<template>
    <div>
        <table class="table table-striped">
            <thead>
                <th></th>
                <th v-for="opt in options">{{ opt.text }}</th>
            </thead>
            <tbody>
                <tr v-for="(item, index) in items">
                    <td>{{ item.question }}</td>
                    <td class="checkbox-inline" v-for="opt in options">
                        <input type="checkbox" :value="opt" v-model="values['question-'+item.id]">
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        name: "Example",
        data() {
            return {
                items: [
                    {id: 1, question: 'Question #1'},
                    {id: 2, question: 'Question #2'},
                    {id: 3, question: 'Question #3'},
                    {id: 4, question: 'Question #4'},
                    {id: 5, question: 'Question #5'},
                ],
                options: [
                    {id: 1, text: 'Option #1'},
                    {id: 2, text: 'Option #2'},
                    {id: 3, text: 'Option #3'},
                    {id: 4, text: 'Option #4'},
                    {id: 5, text: 'Option #5'}
                ],
                values: {}
            }
        }
    }
</script>

<style scoped>

</style>