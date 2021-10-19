<template>
    <div>
        <h1>Add new link to database</h1>
        <form @submit.prevent="addResource()">
            <Label>Title</Label>
            <input v-model="resource.title" type="text"></input>
            <Label>Description</Label>
            <textarea v-model="resource.desc"></textarea>
            <Label>HTML Snippet</Label>
            <textarea v-model="resource.snip"></textarea>
            <button class="btn-primary" type="submit">Submit</button>
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
                    console.log('Added')
                    this.$modal.hide(this.$parent.name);
                })
                .catch(err => console.log(err))

        }
    }
}
</script>
