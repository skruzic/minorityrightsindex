<template>
    <div>
        <!-- Text and Textarea -->
        <TextQuestion v-if="[0,1].includes(type)" :question="question" :type="type"
                      v-model="fields[question.title]" @input="onInput"/>
        <!-- End text and textarea -->

        <!-- Radio -->
        <RadioQuestion v-else-if="type === 2" :question="question"
                       :options="question.options.options" v-model="fields[question.title]"
                       @input="onInput"/>
        <!-- End radio -->

        <!-- Checkbox -->
        <CheckboxQuestion v-else-if="type === 3" :question="question"
                          :options="question.options.options"
                          v-model="fields[question.title]" @input="onInput"/>
        <!-- End checkbox -->

        <!-- Panel -->
        <div v-else-if="type === 4">
            <StaticPanel :question="question" :timeout="question.extras.timeout"
                         v-if="question.extras.dynamic === '0'" v-model="fields[question.title]" @input="onInput"/>
            <DynamicPanel :panel="question.panel" :batch_size="parseInt(question.extras.batch_size)"
                          :timeout="parseInt(question.extras.timeout)" v-else :active_tab_index="activeTabIndex"
                          :section_index="sectionIndex" v-model="fields[question.title]" @input="onInput"/>
        </div>
        <!-- End panel -->

        <!-- Choice array -->
        <div v-else-if="type === 5">
            <div>
                <label>{{ question.question}}</label>
            </div>
            <div class="wrapper">
                <div class="grid-header">
                    <div class="header-item"></div>
                    <div class="header-item" v-for="opt in question.options.options">{{ opt.text }}</div>
                </div>
                <LikertRadioQuestion :question="child" :options="question.options.options"
                                     v-model="fields[child.title]" v-for="child in question.children" :key="child.id"
                                     @input="onRadioInput"/>
            </div>
        </div>
        <!-- End choice array -->

        <!-- Checkbox array -->
        <!--<div v-else-if="type === 6">
            <div class="form-group">
                <label>{{ question.question}}</label>
            </div>
            <table class="table table-striped">
                <thead>
                    <th></th>
                    <th v-for="opt in question.options.options">{{ opt.text }}</th>
                </thead>
                <tbody>
                    <tr v-for="child in question.children" :key="child.id">
                        <td>{{ child.question }}</td>
                        <td v-for="opt in question.options.options">
                            <input type="checkbox" :value="opt.value" v-model="fields['question-'+child.id]"
                                   @change="onRadioInput"/>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>-->
        <!-- End checkbox array -->

        <!-- Static text -->
        <div v-else-if="type === 6">
            <p>{{ question.question }}</p>
        </div>

        <!-- End static text -->
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
    import LikertRadioQuestion from "./LikertRadioQuestion";


    export default {
        name: "question",
        //components: {CheckboxQuestion, RadioQuestion},
        components: {
            CheckboxArray,
            DynamicPanel, TextQuestion, RadioQuestion, CheckboxQuestion, MultipleCheckboxes, StaticPanel,
            LikertRadioQuestion
        },
        //props: ['question', 'value'],
        props: {
            question: {
                type: Object
            },
            activeTabIndex: {
                type: Number
            },
            sectionIndex: {
                type: Number
            }
        },
        data() {
            return {
                fields: {}
            }
        },
        computed: {
            type() {
                return Number(this.question.type);
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
            },
            active_tab() {
                return this.activeTabIndex === this.sectionIndex;
            }
        },
    }
</script>

<style scoped>
    .wrapper {
        display: flex;
        flex-direction: column;
    }

    .grid-header{
        display: flex;
        align-items: flex-end;
    }

    .header-item {
        width:100px;
        text-align:center;
        /*   border:1px solid transparent; */
    }

    .header-item:nth-child(1) {
        width:180px;
    }
</style>