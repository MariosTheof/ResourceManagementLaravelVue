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
                    <td>{{ link.id }}</td>
                    <td>{{ capitalize(link.title) }}</td>
                    <td>{{ link.url }}</td>
                    <td>{{ link.opens_new_tab === 1 ? 'True' : 'False'  }}</td>
                    <td><edit-button @click="showEditModal(link)"></edit-button></td>
                    <td><delete-button @click="showDeleteModal(link)"></delete-button> </td>
                </tr>
                <tr v-if="!isAdmin" class="dark-row" v-for="link in this.links" >
                    <td v-for="value in link">{{ value }}</td>
                    <td v-if="link.opens_new_tab === 1"><a :href="'https://' + link.url" target="_blank">CLICK</a></td>
                    <td v-else><a :href="'https://' + link.url" >CLICK</a></td>
                </tr>

                </tbody>
            </table>

            <modal name="resource-modal"></modal>

            <button v-if="isAdmin" class="btn-primary btn-lg" @click="showAddModal()"> Add new Link </button>
        </div>
    </div>

</template>

<script>
import LinkModalEdit from "./LinkEdit";
import LinkModalDelete from "./LinkDelete";
import LinkModalAdd from "./LinkAdd";

export default {
    components: {
        LinkModalAdd,
        LinkModalEdit,
        LinkModalDelete
    },
    props: ['isAdmin'],
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
        capitalize(string) {
            return string.charAt(0).toUpperCase() + string.slice(1);
        },
        fetchList() {
            this.axios
                .get('/links')
                .then(response => {
                    this.links = response.data;
                    this.updateKey += 1;
                })
        },
        showEditModal(link) {
            this.$modal.show(LinkModalEdit, {
                title: link.title,
                url: link.url,
                resource_id: link.id,
                new_tab: link.opens_new_tab === 1
            }, {'height': 300},{
                'before-close': event =>{
                    this.fetchList()
                }
            })
        },
        showDeleteModal(link) {
            this.$modal.show(LinkModalDelete, {
                title: link.title,
                resource_id: link.id,
            }, {
                'height': 200,
                'classes': 'modal-background'
            },{
                'before-close': event =>{
                    this.fetchList()
                }
            })
        },
        showAddModal() {
          this.$modal.show(LinkModalAdd, {

          }, {'height': 300},{
              'before-close': event =>{
                  this.fetchList()
              }
          })
        },
        hide () {
            console.log('called from parent');

            this.$modal.hide('resource-modal');
        }
    },


}
</script>
<style>
.modal-background {
    background: antiquewhite !important;
}
</style>
