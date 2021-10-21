<template>

    <div class="text-center">
        <h4>Files</h4>
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
                    <td>{{ file.file_path.split('/').at(-1) }}</td>

                    <td><edit-button @click="showEditModal(file)"></edit-button></td>
                    <td><delete-button @click="showDeleteModal(file)"></delete-button> </td>
                </tr>
                <tr v-if="!isAdmin" class="dark-row" v-for="file in this.files" >
                    <td v-for="value in file">{{ value }}</td>


                    <td><a :href="'/fileDownload/' + file.file_path.split('/').at(-1)">
                        Download</a></td>

                </tr>

                </tbody>
            </table>

            <modal name="resource-modal"></modal>

            <button v-if="isAdmin" class="btn-primary btn-lg" @click="showAddModal()"> Add new File </button>
        </div>
    </div>

</template>

<script>
import UploadFile from "./FileAdd";
import DeleteFile from "./FileDelete";
import EditFile from "./FileEdit";

export default {

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
            if (string === null) return
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
            }, {
                'height': 320,
                'classes': 'modal-background'
            },{
                'before-close': event =>{
                    this.fetchList()
                }
            })
        },
        showDeleteModal(file) {
            this.$modal.show(DeleteFile, {
                title: file.name,
                resource_id: file.id,
            }, {
                'height': 200,
                'classes': 'modal-background'
            },{
                'before-close': event =>{
                    this.fetchList()
                }
            })
        },
        showAddModal() {
            this.$modal.show(UploadFile, {

            }, {
                'height': 320,
                'classes': 'modal-background'
            },{
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
