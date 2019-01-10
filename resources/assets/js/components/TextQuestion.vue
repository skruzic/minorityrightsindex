<template>
    <!--<div class="form-group">
        <label>{{ question.question }}</label>
        <input type="text" :name="'question-'+question.id" class="form-control" :value="value" @input="onInput($event)">
    </div>-->

</template>

<script>
    export default {
        name: "TextQuestion",
        props: ['question', 'value'],
        methods: {
            onInput(event) {
                this.$emit('input', event.target.value)
            }
        }
    }
</script>

<style scoped>

</style>