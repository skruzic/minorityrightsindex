<template>
    <div class="grid-row">
        <div class="flex-item">
            {{ question.question }}
        </div>
        <label for="" class="flex-item" v-for="opt in options">
            <input type="radio" :value="opt.value" v-model="selected" @change="updateValue" />
        </label>
    </div>
</template>

<script>
    export default {
        name: "LikertRadioQuestion",
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
                //this.$parent.$emit('input', this.selected);
            }
        },
        mounted() {
            this.$emit('input', this.selected);
        }
    }
</script>

<style scoped>
    .grid-row {
        margin-bottom: 1em
    }
    .grid-row {
        display:flex;
        /*   flex: 1 0 auto; */
        /*   height: auto; */
    }
    .flex-item:before {
        content: '';
        padding-top:26%;
    }
    .flex-item {
        display:flex;
        /*   flex-basis:25%; */
        width:100px;
        border-bottom:1px solid #ccc;
        justify-content: center;
        align-items:center;
        /*   text-align:left; */
        font-size: 1em;
        font-weight:normal;
        color:#999;
    }
    .flex-item:nth-child(1) {
        border:none;
        font-size:1.15em;
        color:#000;
        width:180px;
        justify-content: left;
    }
</style>