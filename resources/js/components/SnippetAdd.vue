<template>
    <div class="container p-4">
    <h1 class="m-2" style="margin-bottom:25px !important;">Add new link to database</h1>
        <form @submit.prevent="addResource()">
            <Label>Title</Label>
            <input v-model="resource.title" type="text"></input>
            <label>Description</label><br>
            <textarea v-model="resource.desc"></textarea>
            <br>
            <label>HTML Snippet</label><br>
            <textarea v-model="resource.snip"></textarea>
            <br>
            <button class="btn-primary modalButton" type="submit">Submit</button>
        </form>
    </div>
</template>
<script>
export default {
    props: ['title', 'desc', 'resource_id', 'snip'],
    data() {
        return {
            resource: {
                title: this.title,
                desc: this.desc,
                snip: this.snip
            }
        }
    },
    methods: {
        addResource() {
            this.axios
                .post('/snippets', this.resource)
                .then(response => {
                    if(response.data === 'error') {
                        this.$toastr.e("Something went wrong");
                    } else {
                        this.$modal.hide(this.$parent.name);
                        this.$toastr.s("Snippet was added successfully", "Resource Added" );
                    }
                })
                .catch(err => {
                    console.log(err);
                    this.$toastr.e("Something went wrong");
                })

        }
    }
}
</script>
