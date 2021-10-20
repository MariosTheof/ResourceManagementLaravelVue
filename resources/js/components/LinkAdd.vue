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
            <button class="btn btn-primary" type="submit">Submit</button>
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
<style>
input{
    width:80%;
    margin-left:20px;
    box-sizing:border-box;
    background:none;
    outline:none;
    resize:none;
    border:0;
    font-family:'Montserrat',
    sans-serif;transition:all .3s;
    border-bottom:2px solid #bebed2}
input:focus{border-bottom:2px solid #78788c}
p:before{content:attr(type);display:block;margin:28px 0 0;font-size:14px;color:#5a5a5a}
button {
    float:right;
    padding:8px 12px;
    margin:8px 0 0;
    border:2px solid #78788c;
    /*background:0;*/
    color: #ffffff;
    cursor:pointer;
    transition:all .3s
}
button:hover {
    background:#78788c;
    color:#fff
}
span{
    margin:0 5px 0 15px
}
label {
    font-size: 1.3rem;
}
</style>
