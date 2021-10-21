<template>

    <div class="text-center">
        <h4>HTML Snippets</h4>
        <div class="table-responsive table-bordered movie-table">
            <table class="table" style="margin-bottom: 100px;" :key="updateKey">
                <thead>

                <tr class= "">
                    <th>ID</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>HTML Snippet</th>
                    <th>###</th>
                </tr>

                </thead>
                <tbody>

                <tr v-if="isAdmin" class="dark-row" v-for="snip in this.snippets" >
                    <td> {{snip.id}} </td>
                    <td> {{ snip.title }}</td>
                    <td> {{snip.desc }} </td>
                    <td> {{ snip.snip }} </td>
                    <td><edit-button @click="showEditModal(snip)"></edit-button></td>
                    <td><delete-button @click="showDeleteModal(snip)"></delete-button> </td>
                </tr>

                <tr v-if="!isAdmin" class="dark-row" v-for="snip in this.snippets" :key="snip.id">
                    <td> {{ snip.title }}</td>
                    <td> {{ snip.id }}</td>
                    <td> {{ snip.desc }}</td>
                    <td :ref="'ref_'+ snip.id"> {{ snip.snip }}</td>
                    <td><a style="color:#1d68a7" @click="copyToClipboard('ref_'+ snip.id)">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clipboard" viewBox="0 0 16 16">
                        <path d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1v-1z"/>
                        <path d="M9.5 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5h3zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3z"/>
                        </svg>
                    </a></td>
                </tr>

                </tbody>
            </table>

            <button v-if="isAdmin" class="btn-primary btn-lg" @click="showAddModal"> Add new Link </button>
        </div>
    </div>

</template>

<script>
import SnippetModalEdit from "./SnippetEdit";
import SnippetModalAdd from "./SnippetAdd";
import SnippetModalDelete from "./SnippetDelete";

export default {
    props: ['isAdmin'],
    data: function() {
        return {
            snippets: [],
            updateKey: 0
        }
    },
    methods: {
      copyToClipboard(reference) {
          navigator.clipboard.writeText(this.$refs[reference][0].textContent);
      },
      showEditModal(snip) {
            this.$modal.show(SnippetModalEdit, {
                title: snip.title,
                desc: snip.desc,
                resource_id: snip.id,
                snip: snip.snip
            }, {
                'height': 430,
                'classes': 'modal-background'
            },{
                'before-close': event =>{
                    this.fetchList()
                }
            })
        },
      showDeleteModal(link) {
            this.$modal.show(SnippetModalDelete, {
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
        this.$modal.show(SnippetModalAdd, {

        }, {
            'height': 430,
            'classes': 'modal-background'
        },{
            'before-close': event =>{
                this.fetchList()
            }
        })
    },
      fetchList() {
          this.axios
              .get('/snippets')
              .then(response => {
                  this.snippets = response.data
              })
      }
    },
    created() {
        this.fetchList();
    }

}


</script>
