<template>

    <div class="text-center">
        <h4>Links</h4>
        <div class="table-responsive table-bordered movie-table">
            <table class="table" style="margin-bottom: 100px;" :key="updateKey">
                <thead>

                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>File</th>
                    <th>#</th>

                </tr>

                </thead>
                <tbody>
                <tr v-if="isAdmin" class="dark-row" v-for="file in this.files" >
                    <td>{{ file.id }}</td>
                    <td>{{ capitalize(file.name) }}</td>
                    <td>{{ file.file_path }}</td>
                    <td><a class="btn-dark" @click="showEditModal(file)">EDIT</a></td>
                    <td><a class="btn-danger" @click="showDeleteModal(file)">DELETE</a></td>
                </tr>
                <tr v-if="!isAdmin" class="dark-row" v-for="file in this.files" >
                    <td v-for="value in file">{{ value }}</td>
                </tr>

                </tbody>
            </table>

            <modal name="resource-modal"></modal>

            <button class="btn-primary btn-lg" @click="showAddModal()"> Add new File </button>
        </div>
    </div>

</template>

<script>
import UploadFile from "./UploadFile";
import DeleteFile from "./DeleteFile";
import EditFile from "./EditFile";

export default {
    components: {

    },
    props: ['isAdmin'],
    data: function() {
        return {
            files: [],
            updateKey: 0
        }
    },
    mounted() {
        this.fetchList();
    },
    methods: {
        capitalize(string) {
            return string.charAt(0).toUpperCase() + string.slice(1);
        },
        fetchList() {
            this.axios
                .get('/files')
                .then(response => {
                    this.files = response.data;
                    this.updateKey += 1;
                })
        },
        showEditModal(file) {
            console.log(file);
            this.$modal.show(EditFile, {
                title: file.name,
                resource_id: file.id,
            }, {},{
                'before-close': event =>{
                    this.fetchList()
                }
            })
        },
        showDeleteModal(file) {
            this.$modal.show(DeleteFile, {
                title: file.name,
                resource_id: file.id,
            }, {},{
                'before-close': event =>{
                    this.fetchList()
                }
            })
        },
        showAddModal() {
            this.$modal.show(UploadFile, {

            }, {},{
                'before-close': event =>{
                    this.fetchList();
                }
            })
        },
        hide () {
            this.$modal.hide('resource-modal');
        }
    },


}


</script>
