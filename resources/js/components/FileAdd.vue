<template>
    <div class="container p-4">
        <h1 class="m-2" style="margin-bottom:25px !important;">File Upload</h1>
        <hr/>
        <label>Title
            <input type="text" v-model="title">
        </label>
        <label>File
            <input type="file" @change="handleFileUpload( $event )"/>
        </label>
        <br>
        <button class="btn-primary modalButton" v-on:click="submitFile()">Submit</button>
    </div>
</template>


<script>
export default {
    data(){
        return {
            file: '',
            title: ''
        }
    },

    methods: {
        submitFile(){
            let formData = new FormData();
            formData.append('file', this.file);
            formData.append('title', this.title);
            axios.post( 'files',
                formData,
                {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                }
            )
                .then(response => {
                    if(response.data === 'error') {
                        this.$toastr.e("Something went wrong");
                    } else {
                        this.$modal.hide(this.$parent.name);
                        this.$toastr.s("File was added successfully", "Resource Added" );
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
