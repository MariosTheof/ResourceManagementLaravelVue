<template>
    <div class="container">
        <div>
            <h2>File Upload</h2>
            <hr/>
            <label>Title
                <input type="text" v-model="title">
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
            ).then(response => {
                console.log('SUCCESS!!');
                this.$modal.hide(this.$parent.name);
            })
            .catch(err => console.log(err))

        },
        handleFileUpload( event ){
            this.file = event.target.files[0];
        },
    }
}

</script>
