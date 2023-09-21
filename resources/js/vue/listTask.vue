<template>
    <div class="task">
        <li v-show="state.edit === false">
            <button :class="[task.completed ? 'completed' : '', 'taskText']" @click="updateCheck()" class="taskName">
                {{ task.name }}
            </button>
            <button class="editButton" @click="startEdit()">
                <font-awesome-icon icon="edit"/>
            </button>
            <button @click="removeTask()" class="trashcan">
                <font-awesome-icon icon="trash" />
            </button>
        </li>
        <li v-show="state.edit === true">
            <input class="form-control col-12" v-model="task.name" @keyup.enter="editTask()" placeholder="Update Todo">
            <button class="editButton" @click="editTask()">
                <font-awesome-icon icon="check"/>
            </button>
            <button @click="cancelEdit()" class="cancelButton">
                <font-awesome-icon icon="close" />
            </button>
        </li>
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
    justify-content: center;
    align-items: center;
}
.taskName {
    cursor:pointer;
    text-align: left!important;
    box-shadow: none;
    border:0;
    background: none;
}
li{
    display:flex;
    width:100%;
}
.trashcan {
    background: none;
    border: none;
    color: #ff0000;
    outline: none;
    cursor: pointer;
    justify-content: right;
    align-items: right;
}
.trashcan:hover {
    background: #ff0000;
    color:white;
}

.editButton {
    background: none;
    border: none;
    color:rgb(11, 134, 243);
    outline: none;
    cursor:pointer;
    justify-content: right;
    align-items: right;
}

.editButton:hover {
    background: rgb(11, 134, 243);
    color:white;
}
.cancelButton{
    background: none;
    border:none;
    outline:none;
    justify-content: right;
    align-items: right;
}
.cancelButton:hover {
    background: black;
    color:white;
    justify-content: right;
    align-items: right;
}

.form-control:focus {
    border-radius: 0.25rem;
    border:none;
    outline:1px;
    border-color: #007bff;
    box-shadow: 0 0 0 0.2rem rgba(0,123,255,0.25);

    border: 0.1;
    border-radius:0.5rem;
    outline: none;
    padding: 4px;
    margin-right: 10px;
    width:100%;
    align-items: center;
}
.form-control{
    width:90%;

}

</style>
