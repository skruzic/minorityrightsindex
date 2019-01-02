<template>
    <div>
        <div v-if="question.type === 0" class="form-group">
            <label>{{ question.question }}</label>
            <input type="text" class="form-control">
        </div>
        <div v-else-if="question.type === 1">
            <label>{{ question.question }}</label>
            <textarea class="form-control"></textarea>
        </div>
        <div v-else-if="question.type === 2">
            <radio-question :question="question"></radio-question>
        </div>
        <div v-else-if="question.type === 3">
            <checkbox-question :question="question"></checkbox-question>
        </div>
        <div v-else-if="question.type === 4">
            <!--<table class="table table-striped">
                <thead>
                    <th v-for="th in JSON.parse(question.question)['header']">{{ th }}</th>
                </thead>
                <tbody>
                    <tr v-for="(tr, key) in JSON.parse(question.question)['body']">
                        <th>{{ key }}</th>
                        <td v-for="td in tr">
                            <span class="d-block">{{ td }}</span>
                            <a href="#" role="button" class="btn btn-outline-primary">Otvori</a>
                        </td>
                    </tr>
                </tbody>
            </table>-->
            <panel-question :question="question"></panel-question>
        </div>
    </div>
</template>

<script>
    //import RadioQuestion from "./RadioQuestion";
    //import CheckboxQuestion from "./CheckboxQuestion";
    export default {
        name: "question",
        //components: {CheckboxQuestion, RadioQuestion},
        props: ['question'],
    }
</script>

<style scoped>

</style>