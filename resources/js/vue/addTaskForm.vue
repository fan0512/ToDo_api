<template>
    <div class="addTask">
        <input type="text" v-model="task.name" placeholder="Add a new todo..." @keyup.enter="addTask()" />

    </div>
</template>

<script>
export default {
    data() {
        return {
            task: {
                name: ''
            }
        }
    },
    methods: {
        addTask() {
            if (this.task.name == "") {
                return;
            }
            axios
            .post("api/task", {
                    task: this.task,
                })
                .then((response) => {
                    if (response.status == 201) {
                        this.task.name = "";
                        this.$emit('reloadlist');
                        alert("Todo have successfully stored!!!");
                    }
                })
                .catch((error) => {
                    console.log(error);
                });
        },
    }
}
</script>

<style scoped>
.addTask {
    display: flex;
    justify-content: center;
    align-items: center;
}
input:focus {
    border-color: #007bff;
    box-shadow: 0 0 0 0.2rem rgba(0,123,255,0.25);
}

input {
    border: 0.1;
    border-radius:0.5rem;
    outline: none;
    padding: 10px;
    margin-right: 10px;
    width:100%;
    align-items: center;
}




</style>
