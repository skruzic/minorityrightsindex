<template>
    <div class="flex-center position-ref">
        <div class="content">
            <div class="m-b-md">
                <!--<h1 class="title m-b-md">{{ campaign.title }}</h1>-->

                <!--<tab-content v-for="section in campaign.sections" :key="section.id" :section="section"></tab-content>-->
                <form-wizard :title="campaign.title" subtitle="" nextButtonText="Dalje" finishButtonText="Kraj"
                             shape="tab" @on-complete="onComplete">
                    <tab-content v-for="section in campaign.sections" :key="section.id" :section="section">
                        <section>
                            <h3>{{ section.title }}</h3>
                            <p>{{ section.description }}</p>
                            <question v-for="question in section.questions" :key="question.id"
                                      :question="question"></question>
                        </section>
                    </tab-content>
                </form-wizard>

            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "campaign",
        //components: {TabContent},
        props: ['id'],
        data: function () {
            return {
                campaign: [],
                fields: {}
            }
        },
        mounted: function () {
            $.get('http://cedim.local/api/campaign/' + this.$route.params.id).always((response) => {
                this.campaign = response
            });
        },
        methods: {
            onComplete: function () {
                //
            }
        }
    }
</script>

<style scoped>
    .full-height {
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
    }
</style>