<template>
    <div class="container">
      <div class="card container-product" v-for='(product, index) in products' :key='index' >
        <h2 class="textcenter">Nome: {{product.name}}</h2>
        <!-- <p>Descrizione: {{product.description}}</p> -->
        <small class="textcenter">Prezzo: {{product.price}}</small>
        <div v-if='isOpen'>
          <transition class="fade">
              <div class="mask-overlay" @click="isOpen = !isOpen">

                <!-- .stop permette di non chiudere il PANEL creato al click sullo stesso -->
                <div class="panel" @click.stop>

                  <!-- stampo il product spedito alla function productShow -->
                    <h2 class="textcenter">{{thisProduct.name}}</h2>
                    <p class="textcenter">{{thisProduct.price}}€</p>

                    <!-- funzioni di carousel -->
                    <carousel :per-page="1" :autoplay="true" :mouse-drag="true">
                        <slide>
                            <img :src='thisProduct.photo'>
                        </slide>
                        <slide>
                           <img :src='thisProduct.photo'>
                        </slide>
                        <slide>
                           <img :src='thisProduct.photo'>
                        </slide>
                        <slide>
                           <img :src='thisProduct.photo'>
                        </slide>
                    </carousel>
                    <p>{{thisProduct.description}}</p>
                </div>
            </div>
          </transition>
        </div>
        <img :src='product.photo' alt="">
        <!-- al click isOpen diventa il contario -->
        <button class="btn btn-danger" @click='isOpen = !isOpen , getThisProduct(product)' type="button" name="button">Visualizza</button>
        <!-- <p>{{isOpen}}</p> -->
      </div>
    </div>
</template>

<style lang="scss">

        .example-slide {
            align-items: center;
            background-color: #666;
            color: #999;
            display: flex;
            font-size: 1.5rem;
            justify-content: center;
            min-height: 10rem;
         }

         .btn-primary, .btn-secondary {
           width: 49%;
           float: left;
           margin: 5px;
         }

         .textcenter {
           text-align: center;
           margin: 0 auto;
         }

</style>


<script>
    import { Carousel, Slide } from 'vue-carousel';
    export default {
        data() {
          return {
            products : [],
            thisProduct : {},
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
        },
        methods: {
            getThisProduct(item) {
                this.thisProduct=item;
            }
        }
    }
</script>
