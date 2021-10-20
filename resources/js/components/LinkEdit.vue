<template>
    <div class="container p-4">
        <h1 class="m-2" style="margin-bottom:25px !important;">Edit Title: {{title}}</h1>
        <form @submit.prevent="editResource()">
            <Label>Title</Label>
            <input v-model="resource.title" type="text"></input>
            <Label>URL</Label>
            <input v-model="resource.url" type="text"></input>
            <Label>Opens in a new tab</Label>
            <input style="width:revert;margin-left:14rem" v-model="resource.opens_new_tab" type="checkbox"></input>
            <button class="btn-primary" type="submit">Submit</button>
        </form>
    </div>
</template>
<script>
export default {
    props: ['title', 'url', 'resource_id', 'new_tab'],
    data() {
        return {
            resource: {
                title: this.title,
                url: this.url,
                opens_new_tab: this.new_tab
            }
        }
    },
    methods: {
        editResource() {
            this.axios
                .put('/links/' + this.resource_id, this.resource)
                .then(response => {
                    console.log('Edited')
                    this.$modal.hide(this.$parent.name);
                })
                .catch(err => console.log(err))
        }
    }
}
</script>

