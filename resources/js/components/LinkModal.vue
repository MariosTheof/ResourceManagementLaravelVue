<template>
    <div>
        <h1>{{title}}</h1>
        <p>{{ url }}</p>
        <form @submit="editProduct()">
            <Label>Title</Label>
            <input v-model="resource.title" type="text"></input>
            <Label>URL</Label>
            <input v-model="resource.url" type="text"></input>
            <Label>Opens in a new tab</Label>
            <input v-model="resource.new_tab" type="checkbox"></input>
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
                new_tab: this.new_tab
            }
        }
    },
    methods: {
        editProduct() {
            this.axios
                .put('/links/' + this.resource_id, this.resource)
                .then(response => {
                    console.log('Edited')
                    // this.$emit('updateList', this.updateKey);
                    // this.updateKey
                })
                .catch(err => console.log(err))

        },
    }
}
</script>
