<template>
    <div>
        <div class="form-group" v-if="question.children.length == 0">
            <label>{{ question.question }}</label>
            <label class="radio-inline" v-for="(opt,num) in question.options.options">
                <input type="radio" :value="num">{{ opt }}
            </label>
        </div>
        <table class="table table-striped" v-else>
            <thead>
                <th></th>
                <th v-for="opt in question.options.options">{{ opt }}</th>
            </thead>
            <tbody>
                <tr>
                    <td>{{ question.question }}</td>
                    <td class="radio-inline" v-for="(opt,num) in question.options.options">
                        <input type="radio" :value="num" :name="'question-'+question.id">
                    </td>
                </tr>
                <tr v-for="child in question.children">
                    <td>{{ child.question }}</td>
                    <td class="radio-inline" v-for="(opt,num) in question.options.options">
                        <input type="radio" :value="num" :name="'question-'+child.id">
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        name: "radio-question",
        props: ['question']
    }
</script>

<style scoped>

</style>