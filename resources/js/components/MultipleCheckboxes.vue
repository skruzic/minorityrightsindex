<template>
    <tr>
        <td>{{ question.question }}</td>
        <td class="checkbox-inline" v-for="option in options">
            <input type="checkbox" :key="option.num" :value="option.num" v-model="selectValue" @change="updateValue">
        </td>
    </tr>
</template>

<script>
    export default {
        name: "MultipleCheckboxes",
        props: ['question', 'options', 'value'],
        data() {
            return {
                selectValue: this.value || []
            }
        },
        updated() {
            this.$emit('input', this.selectValue)
        },
        methods: {
            updateValue() {
                this.$emit('input', this.selectValue)
            }
        }
    }
</script>

<style scoped>

</style>