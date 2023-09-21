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
    background: #f7f7f7;
    border: 0;
    outline: none;
    padding: 5px;
    margin-right: 10px;
}

.plus {
    font-size: 20px;
    cursor: pointer;
}

.active {
    color: #00ce25;
}

.inactive {
    color: #999
}
</style>
