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

                <tr class="dark-row" v-for="snip in this.snippets">
                    <td v-for="value in snip">{{ value }}</td>
                    <td><button type="button" class="btn-primary" @click="copyToClipboard">COPY</button></td>
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
      copyToClipboard() {
          $
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
