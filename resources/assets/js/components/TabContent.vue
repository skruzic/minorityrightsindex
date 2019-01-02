<template>
    <section v-show="active" :id="tabId" :aria-hidden="!active" :aria-labelledby="`step-${tabId}`">
        <h3>{{ section.title }}</h3>
        <p>{{ section.description }}</p>
        <question v-for="question in section.questions" :key="question.id" :question="question"></question>
        <slot :active="active"></slot>
    </section>
</template>

<script>
    export default {
        name: "tab-content",
        props: ['section']
    }
</script>

<style scoped>

</style>