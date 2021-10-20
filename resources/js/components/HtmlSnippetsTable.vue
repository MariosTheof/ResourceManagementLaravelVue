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
                    <td><button type="button" class="btn-primary" @click="copyToClipboard('ref_'+ snip.id)">COPY</button></td>
                </tr>

                </tbody>
            </table>

            <button v-if="isAdmin" class="btn-primary btn-lg" @click="showAddModal"> Add new Link </button>
        </div>
    </div>

</template>

<script>
import SnippetModalEdit from "./SnippetModalEdit";
import SnippetModalAdd from "./SnippetModalAdd";
import SnippetModalDelete from "./SnippetModalDelete";

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
            }, {},{
                'before-close': event =>{
                    this.fetchList()
                }
            })
        },
      showDeleteModal(link) {
            this.$modal.show(SnippetModalDelete, {
                title: link.title,
                resource_id: link.id,
            }, {},{
                'before-close': event =>{
                    this.fetchList()
                }
            })
        },
      showAddModal() {
        this.$modal.show(SnippetModalAdd, {

        }, {},{
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
