<template>
    <div class="container p-4">
        <h1 class="m-2" style="margin-bottom:25px !important;">Edit File</h1>
        <hr/>
        <label>Title
            <input type="text" v-model="name">
        </label>
        <label>File
            <input type="file" @change="handleFileUpload( $event )"/>
        </label>
        <br>
        <button class="btn-primary modalButton"  v-on:click="submitFile()">Submit</button>
    </div>
</template>


    <script>
        export default {
            props:['title', 'resource_id'],
            data(){
                return {
                    file: '',
                    name: this.title
                }
            },
            methods: {
                submitFile(){
                    let formData = new FormData();
                    formData.append('file_path', this.file);
                    formData.append('name', this.name);
                    axios.post(
                        '/fileUpdate/' + this.resource_id,
                        formData )
                        .then(response => {
                            if(response.data === 'error') {
                                this.$toastr.e("Something went wrong");
                            } else {
                                this.$modal.hide(this.$parent.name);
                                this.$toastr.s("File was edited successfully", "Resource Edited" );
                            }
                        })
                        .catch(err => {
                            this.$toastr.e("Something went wrong");
                        })
                },
                handleFileUpload( event ){
                    this.file = event.target.files[0];
                },
            }
        }

    </script>
