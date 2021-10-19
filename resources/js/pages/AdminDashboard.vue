<template>
    <div class="container">
        <div class="row">
            <div class="col">
<!--                <links-table v-bind:isAdmin="isAdmin"></links-table>-->
            </div>
            <div class="col"></div>
                <html-snippets-table v-bind:isAdmin="isAdmin"></html-snippets-table>
            <div class="col"></div>
        </div>

    </div>
</template>

<script>
export default {
    computed: {
        isAdmin() {
            let url = window.location.pathname;
            return url.includes("admin");
        }
    }
}

</script>
