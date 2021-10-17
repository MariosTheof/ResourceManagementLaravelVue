<template>
    <div>
        <h1>{{title}}</h1>
        <form @submit="deleteResource()">
            <h3>Do you want to delete this resource : {{ title }} ?</h3>
            <input type="hidden" :value="this.resource_id"></input>
            <button class="btn-primary" type="submit">Submit</button>
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
                    console.log('Deleted')
                })
                .catch(err => console.log(err))
        }
    }
}
</script>
