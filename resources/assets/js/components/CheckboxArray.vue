<template>Radio Button questions display as a single column of data.
    <div>
        <label>{{ question.question}}</label>
        <!--<table class="table table-striped">
            <thead>
                <th></th>
                <th v-for="opt in question.options.options">{{ opt.text }}</th>
            </thead>
            <tbody>
                --<MultipleCheckboxes v-model="fields['question-'+child.id]" v-for="child in question.children"
                                    :key="child.id" :question="child"
                                    :options="JSON.parse(question.options.options)" @input="onRadioInput"/>-
                <tr v-for="child in question.children" :key="child.id">
                    <td>{{ child.question }}</td>
                    <td v-for="opt in question.options.options">
                        <input type="checkbox" :value="opt.value" v-model="fields['question-'+child.id]"
                               @change="onRadioInput"/>
                    </td>
                </tr>
            </tbody>
        </table>-->
    </div>
</template>

<script>
    export default {
        name: "CheckboxArray",
        props: ['question']
    }
</script>

<style scoped>

</style>