<template>
    <div class="container p-4">

    <h1 class="m-2" style="margin-bottom:25px !important;">{{title}}</h1>
        <form @submit.prevent="deleteResource()">
            <h3>Do you want to delete this resource : {{ title }} ?</h3>
            <input type="hidden" :value="this.resource_id"></input>
            <button class="btn-danger" type="submit" >Delete</button>
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
                    console.log('Deleted');
                    this.$modal.hide(this.$parent.name);
                })
                .catch(err => console.log(err))
        },
    }
}
</script>
