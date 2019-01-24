<template>
    <!--<tr>
        <td>{{ question.question }}</td>
        <td class="radio-inline" v-for="option in options">
            <input type="radio" :key="option.num" :value="option.num" :name="'question-'+question.id" v-model="radioValue" @input="updateValue">
        </td>
    </tr>-->
    <b-form-group :label="question.question">
        <b-form-radio-group v-model="selected" :options="options" @input="updateValue">
        </b-form-radio-group>
    </b-form-group>
</template>

<script>
    export default {
        name: "RadioQuestion",
        props: ['question', 'options', 'value'],
        data() {
            return {
                selected: this.value || 0
            }
        },
        methods: {
            updateValue() {
                this.$emit('input', this.selected);
            }
        },
        mounted() {
            this.$emit('input', this.selected);
        }
    }
</script>

<style scoped>

</style>