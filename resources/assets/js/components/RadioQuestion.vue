<template>
    <tr>
        <td>{{ question.question }}</td>
        <td class="radio-inline" v-for="option in options">
            <input type="radio" :key="option.num" :value="option.num" :name="'question-'+question.id" v-model="radioValue" @input="updateValue">
        </td>
    </tr>
</template>

<script>
    export default {
        name: "RadioQuestion",
        props: ['question', 'options'],
        data() {
            return {
                radioValue: 0
            }
        },
        methods: {
            updateValue() {
                this.$emit('input', this.radioValue);
            }
        }
    }
</script>

<style scoped>

</style>