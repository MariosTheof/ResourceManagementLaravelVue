<template>
    <div>
        <h1>Add new link to database</h1>
        <form @submit.prevent="addResource()">
            <Label>Title</Label>
            <input v-model="resource.title" type="text"></input>
            <Label>URL</Label>
            <input v-model="resource.url" type="text"></input>
            <Label>Opens in a new tab</Label>
            <input v-model="resource.opens_new_tab" type="checkbox"></input>
            <button class="btn-primary" type="submit">Submit</button>
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
                    console.log('Added')
                    this.$modal.hide(this.$parent.name);
                })
                .catch(err => console.log(err))

        }
    }
}
</script>
