<template>
    <div class="container">
      <div v-for='(product, index) in products' :key='index' class="card">
        <h2>Nome: {{product.name}}</h2>
        <!-- <p>Descrizione: {{product.description}}</p> -->
        <small>Prezzo: {{product.price}}</small>

        <!-- al click isOpen diventa il contario -->
        <button @click='isOpen = !isOpen' type="button" name="button">Visualizza</button>
        <p>{{isOpen}}</p>
        <div v-if='isOpen' class="ciao">
          <div class="">
            APERTO
          </div>
        </div>
        <img :src='product.photo' alt="">
      </div>
    </div>
</template>

<style lang="scss">
  .ciao {
    background-color: pink;
  }

</style>


<script>
    export default {
        data() {
          return {
            products : [],
            isOpen : false // var sentinella
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
