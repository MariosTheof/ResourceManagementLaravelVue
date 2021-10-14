<template>

    <div>
        <h4>Links</h4>
        <div class="table-responsive table-bordered movie-table">
            <table class="table" style="margin-bottom: 100px;">
                <thead>

                <tr class= "">
                    <th>Title</th>
                    <th>Description</th>
                    <th>Opens New Tab</th>
                    <th>###</th>
                </tr>

                </thead>
                <tbody>

                <tr class="dark-row">
                    <td>1</td>
                    <td>2 </td>
                    <td>3</td>
                    <td>4</td>
                </tr>

                </tbody>
            </table>

            <button class="btn-primary btn-lg"> Add new Link </button>
        </div>
    </div>

</template>

<script>
export default {
    created() {
    //     this.axios
    //         .get('/links')
    //         .then(response => {
    //             console.log(response);
    //         })

    }
}


</script>
