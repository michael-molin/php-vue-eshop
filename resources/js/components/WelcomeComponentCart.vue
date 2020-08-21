<template>
    <div class="container">
      <div v-for='(product, index) in products' :key='index' class="card">
        <h2>Nome: {{product.name}}</h2>
        <!-- <p>Descrizione: {{product.description}}</p> -->
        <small>Prezzo: {{product.price}}</small>
        <button type="button" name="button">Visualizza</button>
        <button type="button" name="button">Aggiungi al carrello</button>
        <img :src='product.photo' alt="">
      </div>
    </div>
</template>


<script>
    export default {
        data() {
          return {
            products : []

          }

        },
        mounted() {
            // console.log('Welcome Montato');
            axios({
                "method": "GET",
                "url": "api/products",
            }).then((response) => {
                // console.log(response);
                this.products = response.data;
                // console.log(this.products[0].description);

            }).catch((error) => {
                console.log('APi ' + error)
            });
        }
    }
</script>
