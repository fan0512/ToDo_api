<template>
    <div class="todoListContainer">
        <div class="heading">
            <h1 id="title">Todos-today</h1>
            <addTaskForm @reloadlist="getList()" />
        </div>
        <listView :tasks="tasks" @reloadlist="getList()" />
    </div>
</template>

<script>
import addTaskForm from './addTaskForm.vue';
import listView from './listView.vue';

let isFirstLoad=true;

export default {
    data() {
        return {
            tasks: []
        }
    },
    components: {
        addTaskForm,
        listView
    },
    methods: {
        getList() {
            axios.get('api/tasks').then((response)=> {
                this.tasks = response.data;
                if (isFirstLoad){
                    alert("Todos fetched from DB.");
                    isFirstLoad=false;
                }

            }).catch((error) => {
                console.log(error);
            })

        }
    },
    mounted() {
        this.getList();
    }
}
</script>

<style scoped>
.todoListContainer {
    width: 350px;
    margin: auto;
}

.heading {
    /* background: #e6e6e6; */
    padding: 10px
}

#title {
    text-align: left;
}
</style>
