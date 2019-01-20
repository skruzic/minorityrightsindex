<template>
    <div>
        <TextQuestion v-if="[0,1].includes(question.type)" :question="question"
                      v-model="fields['question-'+question.id]" @input="onInput"/>
        <!--<div v-if="question.type === 0">
            <label>{{ question.question }}</label>
            <input type="text" :name="'question-'+question.id" class="form-control" :value="value"
                   @input="onInput($event)">
        </div>-->
        <!--<div v-else-if="question.type === 1">
            <label>{{ question.question }}</label>
            <textarea :name="'question-'+question.id" class="form-control" :value="value"
                      @input="onTextInput($event)"></textarea>
        </div>-->

        <!-- Radio -->
        <!--<div v-else-if="question.type === 2">
            <div class="form-group">
                <label>{{ question.question }}</label>
                <label class="radio-inline" v-for="opt in JSON.parse(question.options.options)">
                    <input type="radio" :value="opt.num" @input="onInput($event)">{{ opt.text }}
                </label>
            </div>
        </div>-->
        <RadioQuestion v-else-if="question.type === 2" :question="question"
                       :options="question.options.options" v-model="fields['question-'+question.id]"
                       @input="onInput"/>
        <!-- End radio -->

        <!-- Checkbox -->
        <!--<div v-else-if="question.type === 3">
            <div class="form-group">
                <label>{{ question.question }}</label>
                <label class="checkbox-inline" v-for="opt in JSON.parse(question.options.options)">
                    <input type="checkbox" :value="opt.num" v-model="fields['question-'+question.id]"
                           @change="onCheckboxInput">{{ opt.text }}
                </label>
            </div>
        </div>-->
        <CheckboxQuestion v-else-if="question.type === 3" :question="question"
                          :options="question.options.options"
                          v-model="fields['question-'+question.id]" @input="onInput"/>
        <!-- End checkbox -->

        <!-- Panel -->
        <div v-else-if="question.type === 4">
            <StaticPanel :question="question" :timeout="question.extras.timeout"
                         v-if="question.extras.dynamic === '0'" />
            <DynamicPanel :panel="question.panel" :batch_size="parseInt(question.extras.batch_size)"
                          :timeout="parseInt(question.extras.timeout)" v-else />
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
                    <th v-for="opt in question.options.options">{{ opt.text }}</th>
                </thead>
                <tbody>
                    <!--<RadioQuestion v-model="fields['question-'+child.id]" v-for="child in question.children"
                                   :key="child.id" :question="child" :options="question.options.options"
                                   @input="onRadioInput"/>-->
                    <tr v-for="child in question.children" :key="child.id">
                        <td>{{ child.question }}</td>
                        <td v-for="opt in question.options.options">
                            <input type="radio" :value="opt.value" v-model="fields['question-'+child.id]"
                                   @change="onRadioInput"/>
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
                    <th v-for="opt in question.options.options">{{ opt.text }}</th>
                </thead>
                <tbody>
                    <!--<MultipleCheckboxes v-model="fields['question-'+child.id]" v-for="child in question.children"
                                        :key="child.id" :question="child"
                                        :options="question.options.options" @input="onRadioInput"/>-->
                    <tr v-for="child in question.children" :key="child.id">
                        <td>{{ child.question }}</td>
                        <td v-for="opt in question.options.options">
                            <input type="checkbox" :value="opt.value" v-model="fields['question-'+child.id]"
                                   @change="onRadioInput"/>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!--<CheckboxArray v-else-if="question.type === 6" :question="question" :options="question.options.options"/>-->
        <!-- End checkbox array -->
    </div>
</template>


<script>
    import TextQuestion from './TextQuestion'
    import RadioQuestion from './RadioQuestion';
    import CheckboxQuestion from './CheckboxQuestion'
    import MultipleCheckboxes from './MultipleCheckboxes';
    import StaticPanel from './StaticPanel';
    import DynamicPanel from "./DynamicPanel";
    import CheckboxArray from "./CheckboxArray";

    export default {
        name: "question",
        //components: {CheckboxQuestion, RadioQuestion},
        components: {
            CheckboxArray,
            DynamicPanel, TextQuestion, RadioQuestion, CheckboxQuestion, MultipleCheckboxes, StaticPanel
        },
        //props: ['question', 'value'],
        props: {
            question: {
                type: Object
            },
            /*value: {
                type: [Array, String, Number, Object]
            }*/
        },
        data() {
            return {
                fields: {}
            }
        },
        methods: {
            onInput() {
                this.$emit('input', this.fields);
            },
            onChange() {
                this.$emit('change', this.fields);
            },
            onTextInput(event) {
                this.$emit('input', event.target.value);
            },
            onRadioInput() {
                this.$emit('input', this.fields);
            },
            onCheckboxInput(event) {
                //this.fields.push(event.target.value);
                this.$emit('input', this.fields);
                //console.log(event.target.name);
            }
        },
    }
</script>

<style scoped>

</style>