<template>
        <div class="container">
          <div v-for='(product, index) in products' :key='index' class="card">
              <h2 class="textcenter">Nome: {{product.name}}</h2>
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
                            <p>In magazzino: {{thisProduct.stock}}</p>
                            <button class="btn btn-danger" id="btn-cart" type="button" name="button" @click="sentToCart(thisProduct)">Aggiungi al Carrello</button>
                        </div>
                    </div>
                  </transition>
              </div>
              <img class="img" :src='product.photo' alt="">
              <div class="box-button">
                <button class="btn btn-primary" id="btn-cart" type="button" name="button" @click="addToCart(product)">Aggiungi al Carrello</button>

                <!-- al click sul visualizza apro la finestra con isOpen, invio all func productShow il prodotto ciclato a riga 3 -->
                <button class="btn btn-secondary" @click='isOpen = !isOpen , productShow(product)' type="button" name="button">Visualizza</button>
              </div>
          </div>
        </div>
</template>

<style lang="scss">
    .card {
        margin: 20px 0;
    }
    .fade {
        transition: opacity 0.9s ease;
    }
    .mask-overlay{
            position: fixed;
            z-index: 9998;
            top: 0px;
            left: 0;
            width: 100vw;
            height: 100vh;
            background-color: rgba(0, 0, 0, 0.5);
            display:flex;
            justify-content: center;
            align-items: center;
        }

        .panel {
            z-index: 9999;
            text-align: center;
            width: 20vw;
            margin: 0 auto;
            padding: 20px 30px;
            background-color: #fff;
            border-radius: 2px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.33);
            transition: all 0.3s ease;
            font-family: Helvetica, Arial, sans-serif;
        }

        .example-slide {
            align-items: center;
            background-color: #666;
            color: #999;
            display: flex;
            font-size: 1.5rem;
            justify-content: center;
            min-height: 10rem;
         }

         .img {
           padding: 15px;
           border-radius: 25px;
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
    import { Carousel, Slide } from 'vue-carousel';  //Importo nel componente i tag slide e carousel dalla cartella node.js vue-carousel
    export default {
        data() {
          return {
            products : [],
            thisProduct : {},
            cartProduct : [],
            isOpen : false, // var sentinella
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
            productShow(product) {
                this.thisProduct=product;
                // console.log(this.thisProduct);
            },

            addToCart(item) {
                this.$store.commit('storeProduct', item); // invoco una mutation dentro un METHOD, con il commit spedisco a storeProduct l item
            }

        },

        components: {
            Carousel,
            Slide
        }
    }
</script>
