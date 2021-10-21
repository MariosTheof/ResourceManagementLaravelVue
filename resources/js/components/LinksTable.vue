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
                    <td>{{ link.id }}</td>
                    <td>{{ capitalize(link.title) }}</td>
                    <td>{{ link.url }}</td>
                    <td>{{ link.opens_new_tab === 1 ? 'True' : 'False'  }}</td>
                    <td v-if="link.opens_new_tab === 1"><a :href="'https://' + link.url" target="_blank">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-up-left" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M7.364 3.5a.5.5 0 0 1 .5-.5H14.5A1.5 1.5 0 0 1 16 4.5v10a1.5 1.5 0 0 1-1.5 1.5h-10A1.5 1.5 0 0 1 3 14.5V7.864a.5.5 0 1 1 1 0V14.5a.5.5 0 0 0 .5.5h10a.5.5 0 0 0 .5-.5v-10a.5.5 0 0 0-.5-.5H7.864a.5.5 0 0 1-.5-.5z"/>
                            <path fill-rule="evenodd" d="M0 .5A.5.5 0 0 1 .5 0h5a.5.5 0 0 1 0 1H1.707l8.147 8.146a.5.5 0 0 1-.708.708L1 1.707V5.5a.5.5 0 0 1-1 0v-5z"/>
                        </svg>
                    </a></td>
                    <td v-else><a :href="'https://' + link.url" >
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-up-left" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M7.364 3.5a.5.5 0 0 1 .5-.5H14.5A1.5 1.5 0 0 1 16 4.5v10a1.5 1.5 0 0 1-1.5 1.5h-10A1.5 1.5 0 0 1 3 14.5V7.864a.5.5 0 1 1 1 0V14.5a.5.5 0 0 0 .5.5h10a.5.5 0 0 0 .5-.5v-10a.5.5 0 0 0-.5-.5H7.864a.5.5 0 0 1-.5-.5z"/>
                        <path fill-rule="evenodd" d="M0 .5A.5.5 0 0 1 .5 0h5a.5.5 0 0 1 0 1H1.707l8.147 8.146a.5.5 0 0 1-.708.708L1 1.707V5.5a.5.5 0 0 1-1 0v-5z"/>
                        </svg>
                    </a></td>
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
            }, {
                'height': 300,
                'classes': 'modal-background'
            },{
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
                'height': 240,
                'classes': 'modal-background'
            },{
                'before-close': event =>{
                    this.fetchList()
                }
            })
        },
        showAddModal() {
          this.$modal.show(LinkModalAdd, {

          }, {
              'height': 300,
              'classes': 'modal-background'
          },{
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
    background: blueviolet !important;
    color: white;
    border-radius: 10px;
}
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
    color:white;
    border-bottom:2px solid #bebed2
}
input:focus {
    border-bottom:2px solid #78788c
}
p:before {
    content:attr(type);
    display:block;
    margin:28px 0 0;
    font-size:14px;
    color:#5a5a5a
}
button {
    padding:8px 12px;
    margin:8px 0 0;
    border:2px solid #78788c;
    background: #8a2be2 !important;
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
.modalButton {
    float:right;
    background: #2176bd!important;
}
</style>
