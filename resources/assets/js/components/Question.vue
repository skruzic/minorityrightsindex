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
        <RadioQuestion v-else-if="question.type === 2" :question="question" :options="JSON.parse(question.options.options)"
                       v-model="fields['question-'+question.id]" @input="onInput"/>
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
        <CheckboxQuestion v-else-if="question.type === 3" :question="question" :options="JSON.parse(question.options.options)"
                          v-model="fields['question-'+question.id]" @input="onInput"/>
        <!-- End checkbox -->

        <!-- Panel -->
        <div v-else-if="question.type === 4">
            <!--<panel-question :question="question"></panel-question>-->
            <PanelQuestion :question="question"></PanelQuestion>
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
                    <!--<tr v-for="child in question.children">
                        <td>{{ child.question }}</td>
                        <td class="radio-inline" v-for="opt in JSON.parse(question.options.options)">
                            <input type="radio" :value="opt.num" :name="'question-'+child.id" v-model="fields['question-'+child.id]" @input="onRadioInput">
                        </td>
                    </tr>-->
                    <RadioQuestion v-model="fields['question-'+child.id]" v-for="child in question.children"
                                   :key="child.id" :question="child" :options="JSON.parse(question.options.options)"
                                   @input="onRadioInput"/>
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
                    <!--<tr v-for="child in question.children" @multiple="multiple">
                        <td>{{ child.question }}</td>
                        <td class="checkbox-inline" v-for="(opt,index) in JSON.parse(question.options.options)">
                            <input type="checkbox" :id="child.id" :value="opt.num" v-model="fields['question-'+child.id]" @change="onCheckboxInput($event)">
                        </td>
                    </tr>-->
                    <MultipleCheckboxes v-model="fields['question-'+child.id]" v-for="child in question.children"
                                        :key="child.id" :question="child"
                                        :options="JSON.parse(question.options.options)" @input="onRadioInput"/>
                </tbody>
            </table>
        </div>
        <!-- End checkbox array -->
    </div>
</template>


<script>
    import TextQuestion from './TextQuestion'
    import RadioQuestion from './RadioQuestion';
    import CheckboxQuestion from './CheckboxQuestion'
    import MultipleCheckboxes from './MultipleCheckboxes';
    import PanelQuestion from './PanelQuestion';

    export default {
        name: "question",
        //components: {CheckboxQuestion, RadioQuestion},
        components: {TextQuestion, RadioQuestion, CheckboxQuestion, MultipleCheckboxes, PanelQuestion},
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
        }
    }
</script>

<style scoped>

</style>