<template>

    <div class="text-center">
        <h4>Links</h4>
        <div class="table-responsive table-bordered movie-table">
            <table class="table" style="margin-bottom: 100px;">
                <thead>

                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>URL</th>
                    <th>Opens New Tab</th>
                    <th>#</th>

                </tr>

                </thead>
                <tbody>

                <tr v-if="" class="dark-row" v-for="link in this.links">
                    <td v-for="value in link">{{ value }}</td>
                    <td v-if="link.opens_new_tab === 1"><a :href="'https://' + link.url" target="_blank">CLICK</a></td>
                    <td v-else><a :href="'https://' + link.url" >CLICK</a></td>
                </tr>

                </tbody>
            </table>

            <button class="btn-primary btn-lg"> Add new Link </button>
        </div>
    </div>

</template>

<script>
import VueRouter from "vue-router";

export default {
    data: function() {
        return {
            links: []
        }
    },
    mounted() {

        this.axios
            .get('/links')
            .then(response => {
                this.links = response.data;
            })
    },
    computed: {
        isLogin() {

            return this.$route.name === 'Login';
        }
    }

}


</script>
