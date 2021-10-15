<template>

    <div class="text-center">
        <h4>HTML Snippets</h4>
        <div class="table-responsive table-bordered movie-table">
            <table class="table" style="margin-bottom: 100px;">
                <thead>

                <tr class= "">
                    <th>ID</th>
                    <th>Description</th>
                    <th>HTML Snippet</th>
                    <th>###</th>
                </tr>

                </thead>
                <tbody>

                <tr class="dark-row" v-for="snip in this.snippets" :key="snip.id">
                    <td> {{ snip.id }}</td>
                    <td> {{ snip.desc }}</td>
                    <td :ref="'ref_'+ snip.id"> {{ snip.snip }}</td>
                    <td><button type="button" class="btn-primary" @click="copyToClipboard('ref_'+ snip.id)">COPY</button></td>
                </tr>

                </tbody>
            </table>

            <button class="btn-primary btn-lg"> Add new Link </button>
        </div>
    </div>

</template>

<script>
export default {
    data: function() {
        return {
            snippets: []
        }
    },
    methods: {
      copyToClipboard(reference) {
          navigator.clipboard.writeText(this.$refs[reference][0].textContent);
      }
    },
    created() {
        this.axios
            .get('/snippets')
            .then(response => {
                this.snippets = response.data
                console.log(response);
            })
    }
}


</script>
