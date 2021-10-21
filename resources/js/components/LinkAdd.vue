<template>
    <div class="container p-4">
        <h1 class="m-2" style="margin-bottom:25px !important;">Add new link to database</h1>

        <form @submit.prevent="addResource()">
            <label>Title</label>
            <input v-model="resource.title" type="text"></input>
            <Label>URL</Label>
            <input v-model="resource.url" type="text"></input>
            <Label>Opens in a new tab</Label>
            <input style="width:revert;margin-left:14rem" v-model="resource.opens_new_tab" type="checkbox"></input>
            <button class="btn btn-primary modalButton" type="submit">Submit</button>
        </form>

    </div>
</template>
<script>
export default {
    data() {
        return {
            resource: {
                title: null,
                url: null,
                opens_new_tab: 0
            }
        }
    },
    methods: {
        addResource() {
            this.axios
                .post('/links', this.resource)
                .then(response => {
                    if(response.data === 'error') {
                        this.$toastr.e("Something went wrong");
                    } else {
                        this.$modal.hide(this.$parent.name);
                        this.$toastr.s("Link was added successfully", "Resource Added" );
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



