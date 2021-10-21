<template>
    <div class="container p-4">

    <h1 class="m-2" style="margin-bottom:25px !important;">{{title}}</h1>
        <form @submit.prevent="deleteResource()">
            <h3>Do you want to delete this resource : {{ title }} ?</h3>
            <input type="hidden" :value="this.resource_id"></input>
            <button class="btn-danger" style="float:right;background: #c51f1a!important;" type="submit" >Delete</button>
        </form>
    </div>
</template>
<script>
export default {
    props: ['title', 'resource_id'],
    data() {
        return {
            // resource: {}
        }
    },
    methods: {
        deleteResource() {
            this.axios
                .delete('/links/' + this.resource_id)
                .then(response => {
                    if(response.data === 'error') {
                        this.$toastr.e("Something went wrong");
                    } else {
                        this.$modal.hide(this.$parent.name);
                        this.$toastr.s("Link was deleted successfully", "Resource Deleted" );
                    }
                })
                .catch(err => {
                    console.log(err);
                    this.$toastr.e("Something went wrong");
                })
        },
    }
}
</script>
