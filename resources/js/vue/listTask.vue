<template>
    <div class="task">
        <div class="col-12" v-show="state.edit === false">
            <span :class="[task.completed ? 'completed' : '', 'taskText']" @click="updateCheck()" class="taskName">
                {{ task.name }}
            </span>
            <button class="editButton" @click="startEdit()">
                <font-awesome-icon icon="edit"/>
            </button>
            <button @click="removeTask()" class="trashcan">
                <font-awesome-icon icon="trash" />
            </button>
        </div>
        <div class="col-12" v-show="state.edit === true">
            <input class="form-control col-12" v-model="task.name" @keyup.enter="editTask()" placeholder="Update Todo">
            <button class="editButton" @click="editTask()">
                <font-awesome-icon icon="check"/>
            </button>
            <button @click="cancelEdit()">
                <font-awesome-icon icon="cancel" />
            </button>
        </div>
    </div>
</template>

<script>
export default {
    props: ["task"],
    data() {
        return {
            state: {
                edit: false,
            },
            data: {
                title: '',
                is_complete: false,
            }
        }
    },
    methods: {
        updateCheck() {
            this.task.completed = !this.task.completed;
            // this.task.editing=true;

            axios
                .put("api/task/" + this.task.id, {
                    task: this.task,
                })
                .then((response) => {
                    if (response.status == 200) {
                        this.$emit('taskChanged');
                        alert("Todo has changed.");
                    }
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        editTask(){
            // this.item.editing=true;
            axios
                .put("api/task/edit/" + this.task.id, {
                    task: this.task,
                },
                )
                .then((response)=>{
                    if(response.status === 200){
                        this.$emit("reloadlist");
                        this.state.edit = false;
                        alert("Edited successfully!");
                    }
                })
                .catch((error)=>{
                    console.log(error);
                });
        },
        removeTask() {
            axios
                .delete("api/task/" + this.task.id)
                .then((response) => {
                    if (response.status == 200) {
                        this.$emit("taskChanged");
                        alert("Deleted successfully!");
                    }
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        startEdit() {
            const t = this;
            if (t.data.is_complete === false) {
                t.state.edit = true;
            }
        },
        cancelEdit() {
            const t = this;
            t.state.edit = false;
            t.data.title = t.todo.title;
        }
    },

    // mounted() {
    //     this.item.completed ? this.$refs.inputRef.checked = false : '';
    // }

};
</script>

<style scoped>
.completed {
    text-decoration: line-through;
    color: #999;
}

.taskText {
    width: 100%;
    /* margin-left: 20px; */
    text-align: left;
}

.task {
    display: flex;
    /* justify-content: center;
    align-items: center; */
}

.trashcan {
    background: #e6e6e6;
    border: none;
    color: #ff0000;
    outline: none;
    cursor: pointer;
    justify-content: right;
    align-items: right;
}

.editButton {
    background: #e6e6e6;
    border: none;
    color:rgb(11, 134, 243);
    outline: none;
    cursor:pointer;
}

.taskName {
    cursor:pointer;
}
</style>
