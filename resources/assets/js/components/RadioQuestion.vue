<template>
    <div>
        <b-form-group :label="question.question">
            <b-form-radio-group v-model="selected" :options="options" @input="updateValue">
            </b-form-radio-group>
        </b-form-group>
    </div>
</template>

<script>
    export default {
        name: "RadioQuestion",
        //props: ['question', 'options', 'value', 'likert'],
        props: {
            question: Object,
            options: Array,
        },
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