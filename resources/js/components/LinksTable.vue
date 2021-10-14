<template>

    <div>
        <h4>Links</h4>
        <div class="table-responsive table-bordered movie-table">
            <table class="table" style="margin-bottom: 100px;">
                <thead>

                <tr>
                    <th v-for="resourceHeader in Object.keys(this.resources[0])"></th>
                </tr>

                </thead>
                <tbody>

<!--                <tr class="dark-row" v-for="x in this.resources">-->
<!--                    <td v-for="value in x">{{ value }}</td>-->
<!--                </tr>-->

                </tbody>
            </table>

            <button class="btn-primary btn-lg"> Add new Link </button>
        </div>
    </div>

</template>

<script>
export default {
    props: ['resource'],
    data: function() {
        return {
            resources: []
        }
    },
    mounted() {
        if (this.resource === 'link') {
            this.axios
                .get('/links')
                .then(response => {
                    this.resources = response.data;
                    console.log(this.resources);
                })
        }
    }
}


</script>
