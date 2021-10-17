<template>

    <div class="text-center">
        <h4>Links</h4>
        <div class="table-responsive table-bordered movie-table">
            <table class="table" style="margin-bottom: 100px;" :key="updateKey">
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

                <tr v-if="isAdmin" class="dark-row" v-for="link in this.links" >
                    <td v-for="value in link">{{ value }}</td>
                    <td><a class="btn-dark" @click="show(link)">EDIT</a></td>
                    <td><a class="btn-danger">DELETE</a></td>
                </tr>
                <tr v-if="!isAdmin" class="dark-row" v-for="link in this.links" >
                    <td v-for="value in link">{{ value }}</td>
                    <td v-if="link.opens_new_tab === 1"><a :href="'https://' + link.url" target="_blank">CLICK</a></td>
                    <td v-else><a :href="'https://' + link.url" >CLICK</a></td>
                </tr>

                </tbody>
            </table>

<!--            <v-dialog name="resource-modal" />-->
            <modal name="resource-modal">
                This is my first modal
            </modal>

            <button class="btn-primary btn-lg"> Add new Link </button>
        </div>
    </div>

</template>

<script>
import LinkModal from "./LinkModal";

export default {
    components: {
      LinkModal
    },
    data: function() {
        return {
            links: [],
            updateKey: 0
        }
    },
    mounted() {
        this.fetchList();
    },
    methods: {
        fetchList() {
            this.axios
                .get('/links')
                .then(response => {
                    this.links = response.data;
                    this.updateKey += 1;
                })
        },
        show (link) {
            this.$modal.show(LinkModal, {
                title: link.title,
                url: link.url,
                resource_id: link.id,
                new_tab: link.opens_new_tab === 1
            }, {},{
                'before-close': event =>{
                    this.fetchList()
                }
            })
        },
        hide () {
            this.$modal.hide('resource-modal');

        }
    },
    computed: {
        isAdmin() {
            let url = window.location.pathname;
            return  url.includes("admin");
        }
    }

}


</script>
