<template>
    <div class="flex-center position-ref">
        <div class="content">
            <form class="m-b-md" @submit.prevent="submit">
                <!--<h1 class="title m-b-md">{{ campaign.title }}</h1>-->

                <!--<tab-content v-for="section in campaign.sections" :key="section.id" :section="section"></tab-content>-->
                <form-wizard :title="campaign.title" subtitle="" nextButtonText="Dalje" finishButtonText="Kraj"
                             shape="tab" @on-complete="submit">
                    <tab-content v-for="section in campaign.sections" :key="section.id" :section="section">
                        <section>
                            <h3>{{ section.title }}</h3>
                            <p>{{ section.description }}</p>
                            <question v-for="question in section.questions" :key="question.id"
                                      :question="question" v-model="fields['question-'+question.id]"></question>
                        </section>
                    </tab-content>
                </form-wizard>
                <!--<Example></Example>-->

            </form>
        </div>
    </div>
</template>

<script>
    import Question from '../components/Question'

    export default {
        name: "campaign",
        components: {Question},
        props: ['id'],
        data: function () {
            return {
                campaign: [],
                fields: {}
            }
        },
        mounted: function () {
            /*$.get('http://cedim.local/api/campaign/' + this.$route.params.id).always((response) => {
                this.campaign = response
            });*/
            axios.get('http://cedim.local/api/campaign/' + this.$route.params.id).then(response => {
                this.campaign = response.data;
            })
        },
        methods: {
            submit() {
                let toSubmit = {
                    campaign: this.campaign.id,
                    data: this.flatten(this.fields)
                };
                    //this.flatten(this.fields);
                console.log(toSubmit);

                axios.post('http://cedim.local/api/campaign', toSubmit).then(response => {
                    console.log(response);
                }).catch(function (error) {
                    console.log(error);
                })
            },
            handleInput(payload) {
                //this.fields.push(payload);
                //console.log(payload);
                //
            },
            flatten(ob) {
                let toReturn = {};

                for (var i in ob) {
                    if (!ob.hasOwnProperty(i)) continue;

                    if ((typeof ob[i]) == 'object' && !Array.isArray(ob[i])) {
                        var flatObject = this.flatten(ob[i]);
                        for (var x in flatObject) {
                            if (!flatObject.hasOwnProperty(x)) continue;

                            toReturn[x] = flatObject[x];
                        }
                    } else {
                        toReturn[i] = ob[i];
                    }
                }
                return toReturn;
            }
        }
    }
</script>

<style scoped>
    /*.full-height {
        height: 100vh;
    }

    .flex-center {
        align-items: center;
        display: flex;
        justify-content: center;
    }

    .position-ref {
        position: relative;
    }

    .top-right {
        position: absolute;
        right: 10px;
        top: 18px;
    }

    .content {
        text-align: center;
    }

    .title {
        font-size: 60px;
    }

    .links > a {
        color: #636b6f;
        padding: 0 25px;
        font-size: 12px;
        font-weight: 600;
        letter-spacing: .1rem;
        text-decoration: none;
        text-transform: uppercase;
    }

    .m-b-md {
        margin-bottom: 30px;
        color: #000000;
    }*/
</style>