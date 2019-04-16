<template>
    <!--<div class="form-group">
        <label>{{ question.question }}</label>
        <input type="text" :name="'question-'+question.id" class="form-control" :value="value" @input="onInput($event)">
    </div>-->
    <b-form-group :label="question.question" label-size="lg">
        <b-form-input v-if="type === 0" v-model="value" @input="onInput"></b-form-input>
        <b-form-textarea v-else v-model="value" @input="onInput"></b-form-textarea>
    </b-form-group>
</template>

<script>
    export default {
        name: "TextQuestion",
        props: ['question', 'type'],
        data() {
            return {
                value: ''
            }
        },
        methods: {
            onInput() {
                this.$emit('input', this.value)
            }
        },
        mounted() {
            this.$emit('input', this.value);
        }
    }
</script>

<style scoped>

</style>