<template>

    <div class="container">
        <div>
            <h2>Edit File</h2>
            <hr/>
            <label>Title
                <input type="text" v-model="name">
            </label>
            <label>File
                <input type="file" @change="handleFileUpload( $event )"/>
            </label>
            <br>
            <button v-on:click="submitFile()">Submit</button>
        </div>
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
                        formData
                    ).then(response => {
                        console.log('SUCCESS!!');
                        this.$modal.hide(this.$parent.name);
                    })
                    .catch(err => {
                        console.log(err);
                    })
                },
                handleFileUpload( event ){
                    this.file = event.target.files[0];
                },
            }
        }

    </script>
