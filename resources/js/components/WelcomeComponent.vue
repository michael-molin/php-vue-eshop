<template>
    <div class="container">

    </div>
</template>




<script>
    export default {
        mounted() {
            console.log('Welcome Montato');
            axios({
                "method": "GET",
                "url": "api/products",
            }).then((response) => {
                console.log(response);
            }).catch((error) => {
                console.log('APi ' + error)
            });
        }
    }
</script>
