<template>
    <div>
        <h1>{{title}}</h1>
        <form @submit.prevent="editResource()">
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
        editResource() {
            this.axios
                .put('/snippets/' + this.resource_id, this.resource)
                .then(response => {
                    console.log('Edited')
                    this.$modal.hide(this.$parent.name);
                })
                .catch(err => console.log(err))
        }
    }
}
</script>
