<template>
    <div>
        <!--<TextQuestion v-if="question.type === 0" :question="question" v-model="fields"></TextQuestion>-->
        <div v-if="question.type === 0">
            <label>{{ question.question }}</label>
            <input type="text" :name="'question-'+question.id" class="form-control" :value="value"
                   @input="onInput($event)">
        </div>
        <div v-else-if="question.type === 1">
            <label>{{ question.question }}</label>
            <textarea :name="'question-'+question.id" class="form-control" :value="value"
                      @input="onInput($event)"></textarea>
        </div>
        <div v-else-if="question.type === 2">
            <div class="form-group" v-if="question.children.length === 0">
                <label>{{ question.question }}</label>
                <label class="radio-inline" v-for="(opt,num) in question.options.options">
                    <input type="radio" :value="num" @input="onInput($event)">{{ opt }}
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
                            <input type="radio" :value="num" :name="'question-'+question.id" v-model="fields['question-'+question.id]" @input="onRadioInput">
                        </td>
                    </tr>
                    <tr v-for="child in question.children">
                        <td>{{ child.question }}</td>
                        <td class="radio-inline" v-for="(opt,num) in question.options.options">
                            <input type="radio" :value="num" :name="'question-'+child.id" v-model="fields['question-'+child.id]" @input="onRadioInput">
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- Checkbox -->
        <div v-else-if="question.type === 3">
            <!--<checkbox-question :question="question"></checkbox-question>-->
            <div class="form-group" v-if="question.children.length === 0">
                <label>{{ question.question }}</label>
                <label class="checkbox-inline" v-for="(opt,num) in question.options.options">
                    <input type="checkbox" :value="num" v-model="fields['question-'+question.id]" @change="onCheckboxInput">{{ opt }}
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
                        <td class="checkbox-inline" v-for="(opt,num) in question.options.options">
                            <input type="checkbox" :value="num" :name="'question-'+question.id" v-model="fields['question-'+question.id]" @change="onCheckboxInput">
                        </td>
                    </tr>
                    <tr v-for="(child, index) in question.children" @multiple="multiple">
                        <td>{{ child.question }}</td>
                        <td class="checkbox-inline" v-for="(opt,num) in question.options.options">
                            <input type="checkbox" :value="num" :name="'question-'+child.id" v-model="selectFields" @change="onCheckboxInput($event)">
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- End checkbox -->

        <!-- Panel -->
        <div v-else-if="question.type === 4">
            <panel-question :question="question"></panel-question>
        </div>
        <!-- End panel -->

        <!-- Choice array -->
        <div v-else-if="question.type === 5">
            <div class="form-group">
                <label>{{ question.question}}</label>
            </div>
            <table class="table table-striped">
                <thead>
                    <th></th>
                    <th v-for="opt in JSON.parse(question.options.options)">{{ opt.text }}</th>
                </thead>
                <tbody>
                    <tr v-for="child in question.children">
                        <td>{{ child.question }}</td>
                        <td class="radio-inline" v-for="opt in JSON.parse(question.options.options)">
                            <input type="radio" :value="opt.num" :name="'question-'+child.id" v-model="fields['question-'+child.id]" @input="onRadioInput">
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- End choice array -->

        <!-- Checkbox array -->
        <div v-else-if="question.type === 6">
            <div class="form-group">
                <label>{{ question.question}}</label>
            </div>
            <table class="table table-striped">
                <thead>
                    <th></th>
                    <th v-for="opt in JSON.parse(question.options.options)">{{ opt.text }}</th>
                </thead>
                <tbody>
                    <tr v-for="child in question.children" @multiple="multiple">
                        <td>{{ child.question }}</td>
                        <td class="checkbox-inline" v-for="(opt,index) in JSON.parse(question.options.options)">
                            <input type="checkbox" :id="child.id" :value="opt.num" v-model="fields['question-'+child.id]" @change="onCheckboxInput($event)">
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- End checkbox array -->
    </div>
</template>


<script>
    import TextQuestion from './TextQuestion'
    import RadioQuestion from "./RadioQuestion";
    import CheckboxQuestion from "./CheckboxQuestion";

    export default {
        name: "question",
        //components: {CheckboxQuestion, RadioQuestion},
        components: {TextQuestion, RadioQuestion, CheckboxQuestion},
        //props: ['question', 'value'],
        props: {
            question: {
                type: Object
            },
            value: {
                type: [Array, String, Number, Object]
            }
        },
        data() {
            return {
                fields: {},
                selectFields: []
            }
        },
        methods: {
            onInput(event) {
                this.$emit('input', event.target.value);
            },
            onRadioInput() {
                this.$emit('input', this.fields);
            },
            onCheckboxInput(event) {
                //this.fields.push(event.target.value);
                //this.$emit('input', this.fields);
                //console.log(event.target.name);

            }
        },
        computed: {
            multiple() {
                return Array.isArray(this.value);
            }
        }
    }
</script>

<style scoped>

</style>