<template>
    <div>
            <li v-for="(task, index) in tasks" :key="index">
                <listTask :task="task" class="task" @taskChanged="$emit('reloadlist')" />
            </li>
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
    padding: 5px;
    margin-top: 5px;
}

li{
    border:1px solid rgb(92, 92, 92);
    list-style-type: none;
    margin-block-start: 1px;
    width:100%;

    position: relative;
    display: desc;
    padding: 0.75rem 1.25rem;

}


</style>
