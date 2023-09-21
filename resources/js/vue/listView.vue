<template>
    <div>
        <div v-for="(task, index) in tasks" :key="index">
            <listTask :task="task" class="task" @taskChanged="$emit('reloadlist')" />
        </div>
    </div>
</template>

<script>
import listTask from './listTask.vue'
    export default {
        props: ['tasks'],
        components: {
            listTask
        }
    }
</script>

<style scoped>
.task {
    background: #e6e6e6;
    padding: 5px;
    margin-top: 5px;
}
</style>
